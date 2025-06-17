<?php include("../template/header.php") ?>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Olimpiadas/admin/config/bd.php';


$stmt = $pdo->prepare("SELECT id, nombre, gmail, rol, fecha_registro FROM cuentas ORDER BY fecha_registro DESC");
$stmt->execute();
$cuentas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<h2 class="mt-4 mb-4">Listado de Cuentas Registradas</h2>

<?php if (count($cuentas) === 0): ?>
    <div class="alert alert-warning">No se encontraron cuentas registradas.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email (Gmail)</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cuentas as $cuenta): ?>
                    <tr>
                        <td><?= htmlspecialchars($cuenta['id']) ?></td>
                        <td><?= htmlspecialchars($cuenta['nombre']) ?></td>
                        <td><?= htmlspecialchars($cuenta['gmail']) ?></td>
                        <td><?= htmlspecialchars($cuenta['rol']) ?></td>
                        <td><?= htmlspecialchars($cuenta['fecha_registro']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include("../template/footer.php") ?>