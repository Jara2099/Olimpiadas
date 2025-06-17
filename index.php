<?php include("template/header.php") ?>

<?php

$destinos = [
    ['id' => 1, 'img' => 'img/BahíaVietnam.jpg', 'alt' => 'Bahía de Ha Long, Vietnam', 'titulo' => 'Bahía de Ha Long, Vietnam'],
    ['id' => 2, 'img' => 'img/CataratasArgentina.jpg', 'alt' => 'Cataratas del Iguazú, Argentina y Brasil', 'titulo' => 'Cataratas del Iguazú, Argentina y Brasil'],
    ['id' => 3, 'img' => 'img/CostaFrancia.jpg', 'alt' => 'Costa de Alabastro, Francia', 'titulo' => 'Costa de Alabastro, Francia'],
    ['id' => 4, 'img' => 'img/CuevasPortugal.jpg', 'alt' => 'Costa de Napali, Kauai - Hawái', 'titulo' => 'Costa de Napali, Kauai - Hawái'],
    ['id' => 5, 'img' => 'img/CuevasPortugal.jpg', 'alt' => 'Cuevas de Benagil, Portugal', 'titulo' => 'Cuevas de Benagil, Portugal'],
    ['id' => 6, 'img' => 'img/Delta del Okavango, Botswana - África.jpg', 'alt' => 'Delta del Okavango, Botswana - África', 'titulo' => 'Delta del Okavango, Botswana - África'],
    ['id' => 7, 'img' => 'img/Desierto de Namib - Namibia, Angola y Sudáfrica.jpg', 'alt' => 'Desierto de Namib - Namibia, Angola y Sudáfrica', 'titulo' => 'Desierto de Namib - Namibia, Angola y Sudáfrica'],
    ['id' => 8, 'img' => 'img/Capadocia, Turquía.jpg', 'alt' => 'Capadocia, Turquía', 'titulo' => 'Capadocia, Turquía'],
    ['id' => 9, 'img' => 'img/Gran Cañón, Arizona, Estados Unidos.jpg', 'alt' => 'Gran Cañón, Arizona, Estados Unidos', 'titulo' => 'Gran Cañón, Arizona, Estados Unidos'],
    ['id' => 10, 'img' => 'img/Isla de Palawan, Filipinas.jpg', 'alt' => 'Isla de Palawan, Filipinas', 'titulo' => 'Isla de Palawan, Filipinas'],
    ['id' => 11, 'img' => 'img/Isla de Skye, Escocia - Reino Unido.jpg', 'alt' => 'Isla de Skye, Escocia - Reino Unido', 'titulo' => 'Isla de Skye, Escocia - Reino Unido'],
    ['id' => 12, 'img' => 'img/Islas Galápagos, Ecuador.jpg', 'alt' => 'Islas Galápagos, Ecuador', 'titulo' => 'Islas Galápagos, Ecuador'],
    ['id' => 13, 'img' => 'img/Kolukkumalai, India.jpg', 'alt' => 'Kolukkumalai, India', 'titulo' => 'Kolukkumalai, India'],
    ['id' => 14, 'img' => 'img/Lago Louise, Canadá.jpg', 'alt' => 'Lago Louise, Canadá', 'titulo' => 'Lago Louise, Canadá'],
    ['id' => 15, 'img' => 'img/Los Campos de Moravia, República Checa.jpg', 'alt' => 'Los Campos de Moravia, República Checa', 'titulo' => 'Los Campos de Moravia, República Checa'],
    ['id' => 16, 'img' => 'img/Milford Sound, Nueva Zelanda.jpg', 'alt' => 'Milford Sound, Nueva Zelanda', 'titulo' => 'Milford Sound, Nueva Zelanda'],
    ['id' => 17, 'img' => 'img/Monte Bromo, Isla de Java - Indonesia.jpg', 'alt' => 'Monte Bromo, Isla de Java - Indonesia', 'titulo' => 'Monte Bromo, Isla de Java - Indonesia'],
    ['id' => 18, 'img' => 'img/Pamukkale, Turquía.jpg', 'alt' => 'Pamukkale, Turquía', 'titulo' => 'Pamukkale, Turquía'],
    ['id' => 19, 'img' => 'img/Salar de Uyuni, Bolivia.jpg', 'alt' => 'Salar de Uyuni, Bolivia', 'titulo' => 'Salar de Uyuni, Bolivia'],
    ['id' => 20, 'img' => 'img/Wulingyuan, China.jpg', 'alt' => 'Wulingyuan, China', 'titulo' => 'Wulingyuan, China'],
];

require $_SERVER['DOCUMENT_ROOT'] . '/Olimpiadas/admin/config/bd.php';


$ahora = date('Y-m-d H:i:s');


$sql = "SELECT * FROM viajes WHERE CONCAT(fecha_salida, ' ', hora_salida) >= :ahora ORDER BY fecha_salida, hora_salida LIMIT 10";
$stmt = $pdo->prepare($sql);
$stmt->execute(['ahora' => $ahora]);
$vuelos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
    <div class="row g-4">
        <?php foreach ($destinos as $destino): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="detalle.php?id=<?= $destino['id'] ?>" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <img src="<?= $destino['img'] ?>" alt="<?= htmlspecialchars($destino['alt']) ?>"
                            class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($destino['titulo']) ?></h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


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