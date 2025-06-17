<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/Olimpiadas/admin/config/bd.php'; // Conexión PDO


// Creando el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['usuario']);
    $gmail = trim($_POST['email']);
    $contrasenia = $_POST['contrasenia'];
    $rol = 'usuario';

    if (strlen($nombre) < 3) {
        $error = "El usuario debe tener al menos 3 caracteres.";
    } elseif (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo electrónico inválido.";
    } elseif (strlen($contrasenia) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $stmt = $pdo->prepare(query: "SELECT COUNT(*) FROM cuentas WHERE nombre = :nombre OR gmail = :gmail");
        $stmt->execute(['nombre' => $nombre, 'gmail' => $gmail]);

        if ($stmt->fetchColumn() > 0) {
            $error = "El usuario o correo ya está registrado.";
        } else {
            $hash = password_hash($contrasenia, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO cuentas (nombre, gmail, contrasenia, rol) VALUES (:nombre, :gmail, :contrasenia, :rol)");
            if ($stmt->execute(['nombre' => $nombre, 'gmail' => $gmail, 'contrasenia' => $hash, 'rol' => $rol])) {
                $success = "Registro exitoso. ¡Podés iniciar sesión!";
            } else {
                $error = "Error al registrar. Intentalo de nuevo.";
            }
        }
    }
}
?>
<?php include("template/header.php") ?>

<div class="container">
    <br><br><br>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header register-header">
                    <i class="fas fa-user-plus"></i> Registrarse
                </div>
                <div class="card-body">
                    <?php if (isset($error))
                        echo "<div class='alert alert-danger'>$error</div>"; ?>
                    <?php if (isset($success))
                        echo "<div class='alert alert-success'>$success</div>"; ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" id="usuario" class="form-control" name="usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" id="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contrasenia">Contraseña</label>
                            <input type="password" id="contrasenia" class="form-control" name="contrasenia" required>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                            <a href="inicio.php" class="btn btn-secondary btn-block">Iniciar sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("template/footer.php") ?>