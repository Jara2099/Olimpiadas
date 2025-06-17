<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'admin/config/bd.php';


$precio_base = 500;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (!isset($_SESSION['usuario_id'])) {
        die("Error: Debe estar logueado para comprar.");
    }

    $usuario_id = $_SESSION['usuario_id'];
    $destino = $_POST['destino'] ?? '';
    $fecha_ida = $_POST['fecha_ida'] ?? '';
    $fecha_vuelta = $_POST['fecha_vuelta'] ?? '';
    $opciones_seleccionadas = $_POST['opciones'] ?? []; 


    $incluye_hotel = 0;
    $incluye_auto = 0;
    $incluye_actividades = 0;


    if (!empty($opciones_seleccionadas)) {

        $placeholders = implode(',', array_fill(0, count($opciones_seleccionadas), '?'));

        $stmt_op = $pdo->prepare("SELECT tipo, precio FROM opciones_extras WHERE id IN ($placeholders)");
        $stmt_op->execute($opciones_seleccionadas);
        $opciones = $stmt_op->fetchAll(PDO::FETCH_ASSOC);

        $precio_total = $precio_base;

        foreach ($opciones as $opcion) {
            $precio_total += floatval($opcion['precio']);

 
            $tipo = strtolower($opcion['tipo']);
            if (strpos($tipo, 'hotel') !== false) {
                $incluye_hotel = 1;
            }
            if (strpos($tipo, 'auto') !== false) {
                $incluye_auto = 1;
            }
            if (strpos($tipo, 'actividad') !== false) {
                $incluye_actividades = 1;
            }
        }
    } else {
        $precio_total = $precio_base;
    }


    $sql = "INSERT INTO compras_viajes 
            (usuario_id, destino, fecha_ida, fecha_vuelta, incluye_hotel, incluye_auto, incluye_actividades, precio_total, creado_en) 
            VALUES 
            (:usuario_id, :destino, :fecha_ida, :fecha_vuelta, :incluye_hotel, :incluye_auto, :incluye_actividades, :precio_total, NOW())";

    $stmt = $pdo->prepare($sql);

    $resultado = $stmt->execute([
        ':usuario_id' => $usuario_id,
        ':destino' => $destino,
        ':fecha_ida' => $fecha_ida,
        ':fecha_vuelta' => $fecha_vuelta,
        ':incluye_hotel' => $incluye_hotel,
        ':incluye_auto' => $incluye_auto,
        ':incluye_actividades' => $incluye_actividades,
        ':precio_total' => $precio_total,
    ]);

    if ($resultado) {
        echo "<div class='alert alert-success text-center'>Compra realizada con éxito.</div>";

    } else {
        echo "<div class='alert alert-danger text-center'>Error al procesar la compra.</div>";
    }
}
$stmt_opciones = $pdo->prepare("SELECT id, tipo, nombre, descripcion, precio FROM opciones_extras WHERE activo = 1");
$stmt_opciones->execute();
$opciones = $stmt_opciones->fetchAll(PDO::FETCH_ASSOC);
$destino_seleccionado = $_GET['destino'] ?? '';
$fecha_ida_seleccionada = $_GET['fecha_ida'] ?? '';
$precio_base = isset($_GET['precio_base']) ? floatval($_GET['precio_base']) : 500; 
?>

<?php include("template/header.php") ?>

<div class="container my-5 d-flex justify-content-center">
    <div class="card shadow" style="max-width: 600px; width: 100%;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Comprar paquete turístico</h4>
        </div>
        <div class="card-body">
            <form method="POST" class="needs-validation" novalidate id="form-compra">
                <div class="mb-3">
                    <label for="destino" class="form-label fw-semibold">Destino</label>
                    <select id="destino" name="destino" class="form-select" required>
                        <optgroup label="Argentina">
                            <option value="Buenos Aires, Argentina">Buenos Aires</option>
                            <option value="Córdoba, Argentina">Córdoba</option>
                            <option value="Mendoza, Argentina">Mendoza</option>
                            <option value="Salta, Argentina">Salta</option>
                            <option value="Bariloche, Argentina">Bariloche</option>
                        </optgroup>
                        <optgroup label="Brasil">
                            <option value="Río de Janeiro, Brasil">Río de Janeiro</option>
                            <option value="São Paulo, Brasil">São Paulo</option>
                            <option value="Salvador, Brasil">Salvador</option>
                            <option value="Brasilia, Brasil">Brasilia</option>
                        </optgroup>
                        <optgroup label="Chile">
                            <option value="Santiago, Chile">Santiago</option>
                            <option value="Valparaíso, Chile">Valparaíso</option>
                            <option value="Viña del Mar, Chile">Viña del Mar</option>
                            <option value="Puerto Montt, Chile">Puerto Montt</option>
                        </optgroup>
                        <optgroup label="España">
                            <option value="Madrid, España">Madrid</option>
                            <option value="Barcelona, España">Barcelona</option>
                            <option value="Sevilla, España">Sevilla</option>
                            <option value="Valencia, España">Valencia</option>
                        </optgroup>
                        <optgroup label="México">
                            <option value="Ciudad de México, México">Ciudad de México</option>
                            <option value="Cancún, México">Cancún</option>
                            <option value="Guadalajara, México">Guadalajara</option>
                            <option value="Monterrey, México">Monterrey</option>
                        </optgroup>
                        <optgroup label="Estados Unidos">
                            <option value="Nueva York, Estados Unidos">Nueva York</option>
                            <option value="Los Ángeles, Estados Unidos">Los Ángeles</option>
                            <option value="Miami, Estados Unidos">Miami</option>
                            <option value="Chicago, Estados Unidos">Chicago</option>
                        </optgroup>
                        <optgroup label="Italia">
                            <option value="Roma, Italia">Roma</option>
                            <option value="Milán, Italia">Milán</option>
                            <option value="Venecia, Italia">Venecia</option>
                            <option value="Florencia, Italia">Florencia</option>
                        </optgroup>
                        <optgroup label="Francia">
                            <option value="París, Francia">París</option>
                            <option value="Marsella, Francia">Marsella</option>
                            <option value="Lyon, Francia">Lyon</option>
                            <option value="Niza, Francia">Niza</option>
                        </optgroup>
                    </select>
                    <div class="invalid-feedback">Por favor seleccione un destino.</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha_ida" class="form-label">Fecha de ida:</label>
                        <input type="date" class="form-control" id="fecha_ida" name="fecha_ida" required
                            value="<?= htmlspecialchars($fecha_ida_seleccionada) ?>">
                        <div class="invalid-feedback">Por favor seleccione una fecha de ida.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_vuelta" class="form-label">Fecha de vuelta:</label>
                        <input type="date" class="form-control" id="fecha_vuelta" name="fecha_vuelta" required>
                        <div class="invalid-feedback">Por favor seleccione una fecha de vuelta.</div>
                    </div>
                </div>

                <fieldset class="mb-4">
                    <legend class="col-form-label pt-0">Opciones adicionales:</legend>

                    <?php foreach ($opciones as $opcion): ?>
                        <div class="form-check">
                            <input class="form-check-input opcion-checkbox" type="checkbox"
                                id="opcion_<?php echo $opcion['id']; ?>" name="opciones[]"
                                value="<?php echo $opcion['id']; ?>" data-precio="<?php echo $opcion['precio']; ?>">
                            <label class="form-check-label" for="opcion_<?php echo $opcion['id']; ?>">
                                <?php echo htmlspecialchars($opcion['tipo']); ?> (+
                                $<?php echo number_format($opcion['precio'], 0, ',', '.'); ?>)
                            </label>
                        </div>
                    <?php endforeach; ?>

                </fieldset>

                <div class="mb-3">
                    <p><strong>Precio base:</strong> $<span
                            id="precio-base"><?php echo number_format($precio_base, 0, ',', '.'); ?></span></p>
                    <p><strong>Total:</strong> $<span
                            id="precio-total"><?php echo number_format($precio_base, 0, ',', '.'); ?></span></p>
                </div>

                <button type="submit" class="btn btn-primary">Confirmar compra</button>
                <a href="/Olimpiadas/index.php" class="btn btn-link ms-3">Volver al inicio</a>
            </form>
        </div>
    </div>
</div>

<script>
    const precioBase = <?= $precio_base ?>;
    (() => {
        'use strict'


        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })

        const checkboxes = document.querySelectorAll('.opcion-checkbox');
        const precioBase = <?php echo $precio_base; ?>;
        const precioTotalSpan = document.getElementById('precio-total');

        function actualizarTotal() {
            let total = precioBase;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseFloat(cb.getAttribute('data-precio')) || 0;
                }
            });

            precioTotalSpan.textContent = total.toLocaleString('es-AR');
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', actualizarTotal);
        });

    })();
</script>

<?php include("template/footer.php") ?>