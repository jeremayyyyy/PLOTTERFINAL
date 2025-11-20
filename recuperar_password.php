<?php
require_once __DIR__ . '/conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($usuario === '' || $email === '') {
        $mensaje = 'Completa usuario y correo electrónico.';
    } else {
        try {
            $conn = pdo_connect();

            // Buscar usuario activo con ese email
            $stmt = $conn->prepare('SELECT id, usuario, email FROM usuarios WHERE usuario = :usuario AND email = :email LIMIT 1');
            $stmt->execute([':usuario' => $usuario, ':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                // No decir que no existe por seguridad
                $mensaje = 'Si los datos son correctos recibirás un correo con el enlace para restablecer.';
            } else {
                // Generar token y guardarlo
                $token = bin2hex(random_bytes(16));
                $insert = $conn->prepare('INSERT INTO recupero_password (usuario_id, token, fecha_creacion, usado) VALUES (:uid, :token, NOW(), 0)');
                $insert->execute([':uid' => $user['id'], ':token' => $token]);

                // Crear URL de reseteo (construcción robusta del path)
                $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
                $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
                $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
                $resetLink = $scheme . '://' . $host . $basePath . '/reset_password.php?token=' . $token;

                // Intentar enviar correo con mail() como fallback
                $subject = 'Restablecer contraseña';
                $message = "Hola {$user['usuario']},\n\nHaz clic en el siguiente enlace para restablecer tu contraseña:\n\n" .
                           $resetLink .
                           "\n\nSi no solicitaste esto, ignora este correo.";
                $headers = 'From: no-reply@' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . "\r\n" .
                           'Reply-To: no-reply@' . ($_SERVER['HTTP_HOST'] . "\r\n") .
                           'X-Mailer: PHP/' . phpversion();

                $sent = false;

                // Envío vía Resend API (primario)
                $resend_api_key = 're_D7pvBiaJ_8HoYkyYuFpAo5skvGTNdjN8H';
                $resend_payload = json_encode([
                    'from' => 'no-reply@' . ($host ?? 'localhost'),
                    'to' => $user['email'],
                    'subject' => $subject,
                    // Enviar HTML simple
                    'html' => nl2br(htmlspecialchars($message))
                ]);

                $ch = curl_init('https://api.resend.com/emails');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $resend_payload);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $resend_api_key
                ]);
                $res = curl_exec($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curl_err = curl_errno($ch) ? curl_error($ch) : null;
                curl_close($ch);

                @file_put_contents(__DIR__ . '/db_errors.log', date('Y-m-d H:i:s') . " - resend response code={$http_code} err=" . ($curl_err ?? 'none') . " resp=" . $res . PHP_EOL, FILE_APPEND);

                if ($http_code >= 200 && $http_code < 300) {
                    $sent = true;
                } else {
                    // Fallback a mail() si Resend falla
                    try {
                        $sent = mail($user['email'], $subject, $message, $headers);
                        @file_put_contents(__DIR__ . '/db_errors.log', date('Y-m-d H:i:s') . " - recuperar_password mail sent=" . ($sent ? '1' : '0') . " to {$user['email']}\n", FILE_APPEND);
                    } catch (Exception $e) {
                        @file_put_contents(__DIR__ . '/db_errors.log', date('Y-m-d H:i:s') . " - recuperar_password mail error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
                    }
                }

                // Mensaje neutro siempre
                $mensaje = 'Si los datos son correctos recibirás un correo con el enlace para restablecer.';

                // Registrar el enlace en el log para pruebas (no exponer en producción)
                @file_put_contents(__DIR__ . '/db_errors.log', date('Y-m-d H:i:s') . " - recuperar_password link: " . $resetLink . PHP_EOL, FILE_APPEND);
            }
        } catch (Exception $e) {
            // Registrar error de DB y mostrar mensaje genérico
            @file_put_contents(__DIR__ . '/db_errors.log', date('Y-m-d H:i:s') . " - recuperar_password DB error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            $mensaje = 'Ocurrió un error al procesar la solicitud. Revisa el log del servidor.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recuperar contraseña - PLOTTER</title>
<link rel="stylesheet" href="./css/app.css">
</head>
<body>

<div class="card">

    <div class="logo-block">
        <img src="./images/logopng.png" class="logo-img" alt="">
        <h1 class="brand-title">PLOTTER</h1>
        <p class="subtitle">Recuperar contraseña</p>
    </div>

    <?php if (!empty($mensaje)): ?>
        <div class="error-message"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <form method="POST">

        <label class="label">Usuario</label>
        <input type="text" name="usuario" class="input" required>

        <label class="label">Correo electrónico</label>
        <input type="email" name="email" class="input" required>

        <button type="submit" class="btn">Enviar enlace</button>
    </form>

    <p class="link-center">
        <a href="./login.php">← Volver al inicio</a>
    </p>

</div>

</body>
</html>