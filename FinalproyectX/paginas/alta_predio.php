<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Candado de seguridad
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado");
    exit();
}

include("../conexion_hosting_ulises.php");

$mensaje = "";
$tipo_mensaje = "";

// Cargamos la lista de propietarios existentes para asignarlos al predio
try {
    $consulta_prop = $conn->query("SELECT id_propietario, nombre, apellido FROM propietarios ORDER BY apellido ASC");
    $propietarios = $consulta_prop->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $propietarios = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cuenta_catastral = isset($_POST['cuenta_catastral']) ? trim($_POST['cuenta_catastral']) : '';
    $direccion        = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
    $valor_fiscal     = isset($_POST['valor_fiscal']) ? trim($_POST['valor_fiscal']) : '0';
    $id_propietario   = isset($_POST['id_propietario']) ? trim($_POST['id_propietario']) : '';

    if (!empty($cuenta_catastral) && !empty($id_propietario)) {
        try {
            $stmt = $conn->prepare("INSERT INTO predios (cuenta_catastral, direccion, valor_fiscal, id_propietario) VALUES (:cuenta, :direccion, :valor, :propietario)");
            $stmt->execute([
                ':cuenta'      => $cuenta_catastral,
                ':direccion'   => $direccion,
                ':valor'       => $valor_fiscal,
                ':propietario' => $id_propietario
            ]);
            $mensaje = "¡Predio / Cuenta Catastral registrada con éxito!";
            $tipo_mensaje = "exito";
        } catch (PDOException $e) {
            $mensaje = "Error al registrar el predio: " . $e->getMessage();
            $tipo_mensaje = "error";
        }
    } else {
        $mensaje = "Por favor, rellena los campos obligatorios.";
        $tipo_mensaje = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Alta Predio</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="dashboard-page">

    <nav class="nav-container-canva">
        <ul class="main-menu-canva">
            <li class="menu-item-canva"><a href="menu.php">Inicio</a></li>
            <li class="menu-item-canva">
                <a href="#">Altas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="alta_propietario.php">Alta de Propietario</a></li>
                    <li><a href="alta_predio.php">Alta de Predio</a></li>
                </ul>
            </li>
            <li class="menu-item-canva">
                <a href="#">Consultas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="consulta_propietario.php">Ver Propietarios</a></li>
                    <li><a href="consulta_predio.php">Ver Predios</a></li>
                </ul>
            </li>
            <li class="menu-item-canva">
                <a href="#">Búsquedas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="buscar_propietario.php">Buscar Propietario</a></li>
                    <li><a href="buscar_predio.php">Buscar Predio</a></li>
                </ul>
            </li>
            <li class="menu-item-canva">
                <a href="#">Actualizaciones ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="modificar_propietario.php">Modificar Propietario</a></li>
                    <li><a href="modificar_predio.php">Modificar Predio</a></li>
                </ul>
            </li>
            <li class="menu-item-canva">
                <a href="#">Bajas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="baja_propietario.php">Eliminar Propietario</a></li>
                    <li><a href="baja_predio.php">Eliminar Predio</a></li>
                </ul>
            </li>
            <li class="menu-item-canva">
                <a href="#">Reportes ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="reporte_propietarios.php">PDF Propietarios</a></li>
                    <li><a href="reporte_predios.php">PDF Predios Generales</a></li>
                    <li><a href="reporte_historial.php">PDF Cuenta Catastral</a></li>
                </ul>
            </li>
            <li class="menu-item-canva"><a href="../index.php" class="btn-salir-canva">Salir</a></li>
        </ul>
    </nav>

    <div class="form-container-canva">
        <h2>Registrar Nuevo Predio</h2>
        <p>Asigna una cuenta catastral y asígnala a un titular legal.</p>

        <?php if (!empty($mensaje)): ?>
            <div class="alerta-canva <?php echo $tipo_mensaje; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="grupo-formulario-canva">
                <label for="cuenta_catastral">Cuenta Catastral *</label>
                <input type="text" id="cuenta_catastral" name="cuenta_catastral" required placeholder="Ej. RE-2024-XXXX">
            </div>

            <div class="grupo-formulario-canva">
                <label for="id_propietario">Propietario Legal *</label>
                <select id="id_propietario" name="id_propietario" required class="select-canva">
                    <option value="">-- Selecciona un propietario --</option>
                    <?php foreach ($propietarios as $p): ?>
                        <option value="<?php echo $p['id_propietario']; ?>">
                            <?php echo htmlspecialchars($p['apellido'] . ", " . $p['nombre']); ?>
                        </option>
                    <?php foreach ($propietarios as $p): ?>
                        <option value="<?php echo $p['id_propietario']; ?>">
                            <?php echo htmlspecialchars($p['apellido'] . ", " . $p['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grupo-formulario-canva">
                <label for="direccion">Dirección del Predio</label>
                <input type="text" id="direccion" name="direccion" placeholder="Ej. Av. Juárez #123, Col. Centro">
            </div>

            <div class="grupo-formulario-canva">
                <label for="valor_fiscal">Valor Fiscal ($)</label>
                <input type="number" id="valor_fiscal" name="valor_fiscal" step="0.01" placeholder="0.00">
            </div>

            <button type="submit" class="btn-guardar-canva">Guardar Propiedad</button>
        </form>
    </div>

</body>
</html>