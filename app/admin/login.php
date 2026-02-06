<?php
session_start();
include 'conexiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['u'];
    $p = $_POST['p'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :u AND contraseña = :p");
    $stmt->execute([':u' => $u, ':p' => $p]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];
        header("Location: ../public/index.php");
        exit();
    } else {
        $error = "Usuario o clave incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login - Three Traveling</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="login-body">
    <div class="login-card">
        <form method="POST">
            <h2>Identificarse</h2>
            <input type="text" name="u" placeholder="Usuario" required class="login-input">
            <input type="password" name="p" placeholder="Contraseña" required class="login-input">
            
            <input type="submit" value="Entrar" class="btn-login">
            
            <?php if (isset($error)): ?>
                <p class="error-msg"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>