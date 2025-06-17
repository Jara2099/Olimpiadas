<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuario_logueado = isset($_SESSION['nombre']);
$rol = $usuario_logueado ? $_SESSION['rol'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>White Wings</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <img class="photo" src="img/icon/logo.png" alt="" width="60px">White Wings
                </a>


                <div id="header">
                    <div id="menu-btn">
                        <div class="btn-hamburger"></div>
                        <div class="btn-hamburger"></div>
                        <div class="btn-hamburger"></div>
                    </div>
                </div>
            </div>
        </nav>

        <ul class="menu-item" id="menu-items">
            <li class="nav-item1"><a class="link" href="productos.php">Vuelos</a></li>
        </ul>


        <div id="sidemenu" class="menu-collapsed">



            <div id="profile">
                <div id="photo-default">
                    <img class="photoU" src="img/icon/user.png" alt="Imagen de usuario por defecto"
                        style="display: block;" width="100px">
                </div>
                <div id="fhoto-user">
                    <img class="photoU" src="#" alt="Imagen del usuario" style="display: none;">
                </div>
                <div id="name">
                    <span>
                        <?php
                        if (!empty($_SESSION['nombre'])) {
                            echo htmlspecialchars($_SESSION['nombre']);
                        } else {
                            echo 'Usuario';
                        }
                        ?>
                    </span>
                </div>
            </div>
            <hr>

            <div id="menu-items">
                <div class="item">
                    <div class="icon">
                        <ul class="menu-items">
                            <li class="nav-item">
                                <a class="items" href="index.php">
                                    <img src="img/icon/home.png" alt="ir al inicio" width="30px" height="30px">
                                    <span class="link">Inicio</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="items" href="/Olimpiadas/productos.php">
                                    <img src="img/icon/fly.png" alt="ir al inicio" width="30px" height="30px">
                                    <span class="link">Vuelos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php if ($usuario_logueado): ?>
                                    <a class="items" href="admin/seccion/cerrar.php">
                                        <img src="img/icon/nologin.png" alt="imagen de cerrar sesion" width="30px">
                                        <span class="link">Cerrar sesión</span>
                                    </a>
                                <?php else: ?>
                                    <a class="items" href="inicio.php">
                                        <img class="photo" src="img/icon/login.png" alt="Imagen de crearse una cuenta"
                                            width="30px">
                                        <span class="link">Iniciar sesión</span>
                                    </a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">