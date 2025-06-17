<?php include("../config/bd.php"); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['guardar'])) {

        $id = $_POST['id'];
        $tipo = $_POST['tipo'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $activo = isset($_POST['activo']) ? 1 : 0;

        $stmt = $pdo->prepare("UPDATE opciones_extras SET tipo = ?, nombre = ?, descripcion = ?, precio = ?, activo = ? WHERE id = ?");
        $stmt->execute([$tipo, $nombre, $descripcion, $precio, $activo, $id]);

    } elseif (isset($_POST['eliminar'])) {

        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM opciones_extras WHERE id = ?");
        $stmt->execute([$id]);

    } else {

        $tipo = $_POST['tipo'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $activo = isset($_POST['activo']) ? 1 : 0;

        $stmt = $pdo->prepare("INSERT INTO opciones_extras (tipo, nombre, descripcion, precio, activo) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$tipo, $nombre, $descripcion, $precio, $activo]);
    }
}
?>

<?php include("../template/header.php") ?>
<div class="container mt-5">
    <div class="container my-5">
        <div class="card shadow-sm rounded-4 p-4">
            <h2 class="mb-4 text-primary fw-bold">Gestión de Opciones Extras</h2>


            <form method="POST" class="row g-3 mb-5 needs-validation" novalidate>
                <div class="col-md-4">
                    <label for="tipo" class="form-label fw-semibold">Tipo</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="" disabled selected>Seleccionar tipo</option>
                        <option value="hotel">Hotel</option>
                        <option value="auto">Auto</option>
                        <option value="actividad">Actividad</option>
                        <option value="comida">Comida</option>
                        <option value="guía">Guía</option>
                    </select>
                    <div class="invalid-feedback">Por favor selecciona un tipo.</div>
                </div>

                <div class="col-md-4">
                    <label for="nombre" class="form-label fw-semibold">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                    <div class="invalid-feedback">El nombre es obligatorio.</div>
                </div>

                <div class="col-md-4">
                    <label for="precio" class="form-label fw-semibold">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" name="precio" class="form-control" step="0.01" min="0" required>
                    </div>
                    <div class="invalid-feedback">Ingrese un precio válido.</div>
                </div>

                <div class="col-12">
                    <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" required></textarea>
                    <div class="invalid-feedback">La descripción es obligatoria.</div>
                </div>

                <div class="col-12 form-check">
                    <input type="checkbox" class="form-check-input" name="activo" id="activo" checked>
                    <label for="activo" class="form-check-label">Activo</label>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-4">Agregar Opción</button>
                </div>
            </form>


            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Activo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        <?php
                        $res = $conn->query("SELECT * FROM opciones_extras");
                        while ($row = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' name='id' value='{$row['id']}'>";
                            echo "<td class='text-center'>{$row['id']}</td>";

                            echo "<td>
        <select name='tipo' class='form-select form-select-sm'>
            <option value='hotel' " . ($row['tipo'] == 'hotel' ? 'selected' : '') . ">Hotel</option>
            <option value='auto' " . ($row['tipo'] == 'auto' ? 'selected' : '') . ">Auto</option>
            <option value='actividad' " . ($row['tipo'] == 'actividad' ? 'selected' : '') . ">Actividad</option>
            <option value='comida' " . ($row['tipo'] == 'comida' ? 'selected' : '') . ">Comida</option>
            <option value='guía' " . ($row['tipo'] == 'guía' ? 'selected' : '') . ">Guía</option>
        </select>
    </td>";

                            echo "<td><input type='text' name='nombre' class='form-control form-control-sm' value='" . htmlspecialchars($row['nombre']) . "'></td>";
                            echo "<td><textarea name='descripcion' class='form-control form-control-sm'>" . htmlspecialchars($row['descripcion']) . "</textarea></td>";
                            echo "<td>
    <div class='input-group input-group-sm'>
        <span class='input-group-text'>$</span>
        <input type='number' name='precio' class='form-control' step='0.01' value='{$row['precio']}'>
    </div>
</td>";

                            echo "<td class='text-center'>
            <div class='form-check'>
                <input class='form-check-input' type='checkbox' name='activo' " . ($row['activo'] ? 'checked' : '') . ">
            </div>
        </td>";

                            echo "<td class='text-center'>
            <button type='submit' name='guardar' class='btn btn-sm btn-success me-1'><i class='bi bi-save'></i> Guardar</button>
            <button type='submit' name='eliminar' class='btn btn-sm btn-danger' onclick=\"return confirm('¿Estás seguro de eliminar esta opción?')\">
                <i class='bi bi-trash'></i> Eliminar
            </button>
        </td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<?php include("../template/footer.php") ?>