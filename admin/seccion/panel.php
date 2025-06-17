<?php include("../template/header.php") ?>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Olimpiadas/admin/config/bd.php';


$stmt = $pdo->prepare("SELECT COUNT(DISTINCT usuario_id) FROM compras_viajes");
$stmt->execute();
$total_viajeros = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM cuentas");
$stmt->execute();
$total_cuentas = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM viajes WHERE fecha_salida >= CURDATE()");
$stmt->execute();
$total_vuelos = $stmt->fetchColumn();

$stmt = $pdo->prepare("
    SELECT COALESCE(SUM(precio_total), 0) 
    FROM compras_viajes 
    WHERE YEAR(creado_en) = YEAR(CURDATE()) 
      AND MONTH(creado_en) = MONTH(CURDATE())
");
$stmt->execute();
$ganancia_mes = $stmt->fetchColumn();
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold">Estadísticas Generales</h2>
    <div class="row g-4 justify-content-center">

        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card shadow-sm border-primary h-100 text-center p-3">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-people-fill fs-1 text-primary"></i>
                    </div>
                    <h5 class="card-title fw-semibold">Viajeros</h5>
                    <p class="display-4 fw-bold text-primary"><?= htmlspecialchars($total_viajeros) ?></p>
                    <p class="card-text text-muted">Personas que pidieron viajes</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card shadow-sm border-success h-100 text-center p-3">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-person-check-fill fs-1 text-success"></i>
                    </div>
                    <h5 class="card-title fw-semibold">Cuentas Registradas</h5>
                    <p class="display-4 fw-bold text-success"><?= htmlspecialchars($total_cuentas) ?></p>
                    <p class="card-text text-muted">Usuarios registrados en el sistema</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card shadow-sm border-warning h-100 text-center p-3">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-airplane-engines-fill fs-1 text-warning"></i>
                    </div>
                    <h5 class="card-title fw-semibold">Vuelos Programados</h5>
                    <p class="display-4 fw-bold text-warning"><?= htmlspecialchars($total_vuelos) ?></p>
                    <p class="card-text text-muted">Vuelos pendientes de despegar</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card shadow-sm border-danger h-100 text-center p-3">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-cash-stack fs-1 text-danger"></i>
                    </div>
                    <h5 class="card-title fw-semibold">Ganancia del Mes</h5>
                    <p class="display-4 fw-bold text-danger">$ <?= number_format($ganancia_mes, 2, ',', '.') ?></p>
                    <p class="card-text text-muted">Ingresos obtenidos en el mes actual</p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include("../template/footer.php") ?>