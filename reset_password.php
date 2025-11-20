<?php
require_once __DIR__ . '/conexion.php';

$token_valido = false;
$mensaje = '';

try {
    $conn = pdo_connect();

    // Si se envía el formulario para actualizar la contraseña
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['token']) && !empty($_POST['password'])) {
        $token = $_POST['token'];
        $password = $_POST['password'];

        // Validaciones básicas
        if (strlen($password) < 6) {
            $mensaje = 'La contraseña debe tener al menos 6 caracteres.';
            $token_valido = true; // mostrar formulario otra vez
        } else {
            // Buscar token válido
            $stmt = $conn->prepare('SELECT id, usuario_id, usado FROM recupero_password WHERE token = :token LIMIT 1');
            $stmt->execute([':token' => $token]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                $mensaje = 'Token inválido o expirado.';
                $token_valido = false;
            } elseif ($row['usado']) {
                $mensaje = 'Este enlace ya fue utilizado.';
                $token_valido = false;
            } else {
                // Actualizar contraseña del usuario
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $upd = $conn->prepare('UPDATE usuarios SET password = :pass WHERE id = :uid');
                $upd->execute([':pass' => $hash, ':uid' => $row['usuario_id']]);

                // Marcar token como usado
                $mark = $conn->prepare('UPDATE recupero_password SET usado = 1 WHERE id = :id');
                $mark->execute([':id' => $row['id']]);

                // Éxito: redirigir a login con mensaje
                header('Location: login.php?reset=ok');
                exit;
            }
        }
    }

    // Si hay token en GET, validar y mostrar formulario
    if (isset($_GET['token']) && !$token_valido) {
        $token = $_GET['token'];
        $stmt = $conn->prepare('SELECT id, usuario_id, usado FROM recupero_password WHERE token = :token LIMIT 1');
        $stmt->execute([':token' => $token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && !$row['usado']) {
            $token_valido = true;
        } else {
            $mensaje = 'Token inválido o ya utilizado.';
            $token_valido = false;
        }
    }

} catch (Exception $e) {
    @file_put_contents(__DIR__ . '/db_errors.log', date('Y-m-d H:i:s') . " - reset_password error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
    $mensaje = 'Ocurrió un error al procesar la solicitud. Intenta más tarde.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Restablecer Contraseña - PLOTTER</title>
<link rel="stylesheet" href="./css/app.css">
</head>
<body>

<div class="card">

    <div class="logo-block">
        <img src="./images/logopng.png" class="logo-img" alt="">
        <h1 class="brand-title">PLOTTER</h1>
        <p class="subtitle">Restablecer contraseña</p>
    </div>

    <?php if ($token_valido): ?>

        <form method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']) ?>">

            <label class="label">Nueva contraseña</label>
            <input type="password" name="password" class="input" required>

            <button class="btn">Actualizar contraseña</button>
        </form>

    <?php else: ?>

        <div class="error-message"><?= $mensaje ?></div>
        <p class="link-center"><a href="login.php">Volver al inicio</a></p>

    <?php endif; ?>

</div>

</body>
</html>