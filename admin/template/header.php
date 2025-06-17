<?php
session_start();
if (!isset($_SESSION['nombre']) || $_SESSION['rol'] !== 'admin') {
    header("Location: /Olimpiadas/inicio.php");
    exit;
}

$nombreUsuario = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Olimpiadas/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Olimpiadas/css/style.css">
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
                <a class="navbar-brand d-flex align-items-center" href="/Olimpiadas/admin/index.php">
                    <img class="link" src="/Olimpiadas/img/icon/logo.png" alt="" width="60px">White Wings
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
            <li class="nav-item1"><a class="link" href="/Olimpiadas/admin/seccion/panel.php">panel</a></li>
            <li class="nav-item1"><a class="link" href="/Olimpiadas/admin/seccion/opciones_extras.php">agregar opciones</a></li>
            <li class="nav-item1"><a class="link" href="/Olimpiadas/admin/seccion/control_cuentas.php">control de cuentas</a></li>
            <li class="nav-item1"><a class="link" href="/Olimpiadas/admin/seccion/Control_viajes.php">agregar vuelo</a></li>
        </ul>


        <div id="sidemenu" class="menu-collapsed">

            <div id="profile">
                <div id="photo-default">
                    <img class="photoU" src="/Olimpiadas/img/icon/user.png" alt="Imagen de usuario por defecto"
                        style="display: block;" width="100px">
                </div>
                <div id="fhoto-user">
                    <img class="photoU" src="#" alt="Imagen del usuario" style="display: none;">
                </div>
                <div id="name">
                    <span>
                        <?= htmlspecialchars($nombreUsuario) ?>
                    </span>
                </div>
            </div>
            <hr>

            <div id="menu-items">
                <div class="item">
                    <div class="icon">
                        <ul class="menu-items">
                            <li class="nav-item">
                                <a class="items" href="/Olimpiadas/admin/index.php">
                                    <img src="/Olimpiadas/img/icon/home.png" alt="ir al inicio" width="30px"
                                        height="30px">
                                    <span class="link">Inicio</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="items" href="/Olimpiadas/admin/seccion/Control_viajes.php">
                                    <img src="/Olimpiadas/img/icon/fly.png" alt="configuracion de tu cuenta"
                                        width="30px" height="30px">
                                    <span class="link">Agregar vuelos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="items" href="/Olimpiadas/admin/seccion/control_cuentas.php">
                                    <img src="/Olimpiadas/img/icon/config.png" alt="configuracion de tu cuenta"
                                        width="30px" height="30px">
                                    <span class="link">Ver cuentas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="items" href="/Olimpiadas/admin/seccion/cerrar.php">
                                    <img src="/Olimpiadas/img/icon/nologin.png" alt="configuracion de tu cuenta"
                                        width="30px" height="30px">
                                    <span class="link">Cerrar sesion</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">