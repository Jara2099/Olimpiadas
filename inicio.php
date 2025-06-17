<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Invitado';

require $_SERVER['DOCUMENT_ROOT'] . '/Olimpiadas/admin/config/bd.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_input = trim($_POST['usuario']);
    $contrasenia = $_POST['contrasenia'];
    $stmt = $pdo->prepare("SELECT * FROM cuentas WHERE gmail = :input OR nombre = :input");
    $stmt->execute(['input' => $usuario_input]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contrasenia, $usuario['contrasenia'])) {
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];
        $_SESSION['usuario_id'] = $usuario['id'];
        if ($usuario['rol'] === 'admin') {
            header("Location: /Olimpiadas/admin/index.php"); 
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<?php include("template/header.php"); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <strong>Iniciar sesión</strong>
                </div>
                <div class="card-body">
                    <?php if (isset($error))
                        echo "<div class='alert alert-danger'>$error</div>"; ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contrasenia">Contraseña</label>
                            <input type="password" name="contrasenia" id="contrasenia" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                            <a href="registro.php" class="btn btn-secondary">Registrarse</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("template/footer.php"); ?>