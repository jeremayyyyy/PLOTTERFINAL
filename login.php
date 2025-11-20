<?php
session_start();
include "conexion.php";

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // Ahora usamos $pdo (creado en conexion.php)
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $row['password'])) {

            $_SESSION['usuario'] = $usuario;
            $_SESSION['logged_in'] = true;
            header("Location: ./principalp/landing.php");
            exit();

        } elseif ($password === $row['password']) {

            $nuevo_hash = password_hash($password, PASSWORD_DEFAULT);
            $pdo->prepare("UPDATE usuarios SET password = ? WHERE id = ?")
                 ->execute([$nuevo_hash, $row['id']]);

            $_SESSION['usuario'] = $usuario;
            $_SESSION['logged_in'] = true;
            header("Location: ./principalp/landing.php");
            exit();
        }
    }

    $error_message = "Usuario o contraseña incorrectos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PLOTTER</title>
    <link rel="stylesheet" href="./css/app.css">
</head>
<body>

<div class="card">

    <div class="logo-block">
        <img src="./images/logopng.png" class="logo-img" alt="">
        <h1 class="brand-title">PLOTTER</h1>
        <p class="subtitle">Bienvenido. Complete sus datos.</p>
    </div>

    <?php if ($error_message): ?>
        <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <label class="label">Usuario</label>
        <input type="text" name="usuario" class="input" required>

        <label class="label">Contraseña</label>
        <input type="password" name="password" class="input" required>

        <button class="btn">Ingresar</button>
    </form>

    <p class="link-center">
        <a href="./recuperar_password.php">¿Olvidaste tu contraseña?</a>
    </p>

</div>

</body>
</html>