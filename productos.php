<?php include("template/header.php") ?>

<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/Olimpiadas/admin/config/bd.php';

$ahora = date('Y-m-d H:i:s');

$sql = "SELECT * FROM viajes WHERE CONCAT(fecha_salida, ' ', hora_salida) >= :ahora ORDER BY fecha_salida, hora_salida LIMIT 10";
$stmt = $pdo->prepare($sql);
$stmt->execute(['ahora' => $ahora]);
$vuelos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container my-5">
    <h2 class="mb-4" id="vuelos">Vuelos a despegar</h2>

    <?php if (count($vuelos) > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Destino</th>
                        <th>Precio Base</th>
                        <th>Fecha Salida</th>
                        <th>Hora Salida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vuelos as $vuelo): ?>
                        <tr onclick="window.location='comprar_boleto.php?destino=<?= urlencode($vuelo['destino']) ?>&fecha_ida=<?= urlencode($vuelo['fecha_salida']) ?>&precio_base=<?= $vuelo['precio_base'] ?>'"
                            style="cursor:pointer;">
                            <td><?= htmlspecialchars($vuelo['id']) ?></td>
                            <td><?= htmlspecialchars($vuelo['destino']) ?></td>
                            <td>$<?= number_format($vuelo['precio_base'], 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($vuelo['fecha_salida']) ?></td>
                            <td><?= htmlspecialchars($vuelo['hora_salida']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No hay vuelos disponibles para despegar próximamente.</p>
    <?php endif; ?>
</div>



<?php include("template/footer.php") ?>