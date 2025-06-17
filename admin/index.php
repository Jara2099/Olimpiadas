<?php include("template/header.php") ?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Bienvenido al Panel de Administración</h1>
        <p class="lead">Aquí podrás gestionar todo lo relacionado con los viajes y usuarios del sistema.</p>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Guía Rápida de Uso</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">

                <li class="list-group-item">
                    <h6 class="fw-bold">1. Panel General</h6>
                    <p>Visualizá datos clave como:</p>
                    <ul>
                        <li>Cantidad de cuentas registradas</li>
                        <li>Vuelos programados para despegar</li>
                        <li>Personas que solicitaron viajes</li>
                        <li>Ganancias obtenidas en el mes</li>
                    </ul>
                </li>

                <li class="list-group-item">
                    <h6 class="fw-bold">2. Agregar Opciones</h6>
                    <p>Permití a los usuarios elegir servicios adicionales en su viaje como hotel, auto, comida o actividades turísticas.</p>
                </li>

                <li class="list-group-item">
                    <h6 class="fw-bold">3. Control de Cuentas</h6>
                    <p>Revisá todas las cuentas registradas, incluyendo su nombre, email, rol y fecha de registro. También podés ver su contraseña o eliminar la cuenta si es necesario.</p>
                </li>

                <li class="list-group-item">
                    <h6 class="fw-bold">4. Agregar Vuelo</h6>
                    <p>Cargá un nuevo viaje especificando:</p>
                    <ul>
                        <li>Destino</li>
                        <li>Precio base</li>
                        <li>Fecha de salida</li>
                        <li>Hora de salida</li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>



<?php include("template/footer.php") ?>