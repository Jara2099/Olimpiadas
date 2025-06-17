<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Olimpiadas/admin/config/bd.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $destino = $_POST['destino'] ?? '';
    $precio_base = isset($_POST['precio_base']) ? floatval($_POST['precio_base']) : 0;
    $fecha_salida = $_POST['fecha_salida'] ?? '';
    $hora_salida = $_POST['hora_salida'] ?? '';
    $id = $_POST['id'] ?? null;

    if (isset($_POST['action'])) {

        if ($_POST['action'] == 'agregar' || ($_POST['action'] == 'editar' && $id)) {
            if ($precio_base < 10 || $precio_base > 99999) {
                die('El precio base debe estar entre 10 y 99999.');
            }
        }

        if ($_POST['action'] == 'agregar') {

            $stmt = $pdo->prepare("INSERT INTO viajes (destino, precio_base, fecha_salida, hora_salida) VALUES (?, ?, ?, ?)");
            $stmt->execute([$destino, $precio_base, $fecha_salida, $hora_salida]);
            header('Location: Control_viajes.php');
            exit;
        }

        if ($_POST['action'] == 'editar' && $id) {

            $stmt = $pdo->prepare("UPDATE viajes SET destino = ?, precio_base = ?, fecha_salida = ?, hora_salida = ? WHERE id = ?");
            $stmt->execute([$destino, $precio_base, $fecha_salida, $hora_salida, $id]);
            header('Location: Control_viajes.php');
            exit;
        }

        if ($_POST['action'] == 'eliminar' && $id) {

            $stmt = $pdo->prepare("DELETE FROM viajes WHERE id = ?");
            $stmt->execute([$id]);
            header('Location: Control_viajes.php');
            exit;
        }
    }
}


$viajes = $pdo->query("SELECT * FROM viajes ORDER BY creado_en DESC")->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../template/header.php") ?>

<h1 class="text-center my-5 fw-bold">Administrar Viajes</h1>


<div class="container mb-5">
    <h2 class="mb-4 text-center fw-semibold">Agregar Viaje Nuevo</h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <form method="POST" class="row g-4">
                <input type="hidden" name="action" value="agregar" />

                <div class="col-md-6">
                    <label for="destino" class="form-label fw-semibold">Destino</label>
                    <select id="destino" name="destino" class="form-select form-select-lg" required>
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
                </div>

                <div class="col-md-6">
                    <label for="precio_base" class="form-label fw-semibold">Precio base</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.50" name="precio_base" id="precio_base" class="form-control"
                            required min="10" max="99999" placeholder="Ej: 1500.00" aria-describedby="precioHelp">
                    </div>
                    <div id="precioHelp" class="form-text">Ingrese el precio base en pesos argentinos.</div>
                </div>

                <div class="col-md-6">
                    <label for="fecha_salida" class="form-label fw-semibold">Fecha de salida</label>
                    <input type="date" name="fecha_salida" id="fecha_salida" class="form-control form-control-lg"
                        required aria-describedby="fechaHelp">
                    <div id="fechaHelp" class="form-text">Selecciona la fecha de salida del viaje.</div>
                </div>

                <div class="col-md-6">
                    <label for="hora_salida" class="form-label fw-semibold">Hora de salida</label>
                    <input type="time" name="hora_salida" id="hora_salida" class="form-control form-control-lg" required
                        aria-describedby="horaHelp">
                    <div id="horaHelp" class="form-text">Selecciona la hora de salida.</div>
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-success btn-lg px-5 fw-semibold">
                        <i class="bi bi-plus-circle me-2"></i>Agregar Viaje
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <h2 class="mb-4">Listado de viajes</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Destino</th>
                    <th class="text-end">Precio Base</th>
                    <th class="text-center">Fecha Salida</th>
                    <th class="text-center">Hora Salida</th>
                    <th>Creado en</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viajes as $viaje): ?>
                    <tr>
                        <td><?= htmlspecialchars($viaje['id']) ?></td>
                        <td><?= htmlspecialchars($viaje['destino']) ?></td>
                        <td class="text-end">$<?= number_format($viaje['precio_base'], 2) ?></td>
                        <td class="text-center"><?= htmlspecialchars($viaje['fecha_salida']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($viaje['hora_salida']) ?></td>
                        <td><?= htmlspecialchars($viaje['creado_en']) ?></td>
                        <td>
                            <form method="POST" class="mb-2 d-flex flex-wrap gap-2 align-items-center">
                                <input type="hidden" name="action" value="editar" />
                                <input type="hidden" name="id" value="<?= $viaje['id'] ?>" />

                                <select name="destino" class="form-select form-select-sm" required
                                    style="min-width: 140px;">
                                    <?php
                                    $destinos = [
                                        "Argentina" => ["Buenos Aires", "Córdoba", "Mendoza", "Salta", "Bariloche"],
                                        "Brasil" => ["Río de Janeiro", "São Paulo", "Salvador", "Brasilia"],
                                        "Chile" => ["Santiago", "Valparaíso", "Viña del Mar", "Puerto Montt"],
                                        "España" => ["Madrid", "Barcelona", "Sevilla", "Valencia"],
                                        "México" => ["Ciudad de México", "Cancún", "Guadalajara", "Monterrey"],
                                        "Estados Unidos" => ["Nueva York", "Los Ángeles", "Miami", "Chicago"],
                                        "Italia" => ["Roma", "Milán", "Venecia", "Florencia"],
                                        "Francia" => ["París", "Marsella", "Lyon", "Niza"],
                                    ];

                                    foreach ($destinos as $pais => $ciudades) {
                                        echo "<optgroup label=\"$pais\">";
                                        foreach ($ciudades as $ciudad) {
                                            $valor = "$ciudad, $pais";
                                            $selected = ($viaje['destino'] === $valor) ? 'selected' : '';
                                            echo "<option value=\"$valor\" $selected>$ciudad</option>";
                                        }
                                        echo "</optgroup>";
                                    }
                                    ?>
                                </select>

                                <div class="input-group input-group-sm" style="min-width: 120px;">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="precio_base" value="<?= $viaje['precio_base'] ?>"
                                        class="form-control" required min="10" max="99999">
                                </div>

                                <input type="date" name="fecha_salida" value="<?= $viaje['fecha_salida'] ?>"
                                    class="form-control form-control-sm" required style="min-width: 140px;">

                                <input type="time" name="hora_salida" value="<?= $viaje['hora_salida'] ?>"
                                    class="form-control form-control-sm" required style="min-width: 110px;">

                                <button type="submit" class="btn btn-warning btn-sm">Guardar</button>
                            </form>

                            <form method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este viaje?');">
                                <input type="hidden" name="action" value="eliminar" />
                                <input type="hidden" name="id" value="<?= $viaje['id'] ?>" />
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($viajes)): ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay viajes registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>









<?php include("../template/footer.php") ?>