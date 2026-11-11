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

// Incluimos la conexión (recuerda que ahora está en la raíz, por eso usamos ../)
include("../conexion_hosting_ulises.php");

$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recolectamos los campos del formulario (ajusta los nombres según tus columnas reales si es necesario)
    $nombre    = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido  = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $curp      = isset($_POST['curp']) ? trim($_POST['curp']) : '';
    $telefono  = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

    if (!empty($nombre) && !empty($apellido)) {
        try {
            // Preparamos la inserción sql
            $stmt = $conn->prepare("INSERT INTO propietarios (nombre, apellido, curp, telefono) VALUES (:nombre, :apellido, :curp, :telefono)");
            $stmt->execute([
                ':nombre'   => $nombre,
                ':apellido' => $apellido,
                ':curp'     => $curp,
                ':telefono' => $telefono
            ]);
            $mensaje = "¡Propietario registrado exitosamente!";
            $tipo_mensaje = "exito";
        } catch (PDOException $e) {
            $mensaje = "Error al registrar: " . $e->getMessage();
            $tipo_mensaje = "error";
        }
    } else {
        $mensaje = "Por favor, completa los campos obligatorios.";
        $tipo_mensaje = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Alta Propietario</title>
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
        <h2>Registrar Nuevo Propietario</h2>
        <p>Introduce la información oficial del titular de la cuenta catastral.</p>

        <?php if (!empty($mensaje)): ?>
            <div class="alerta-canva <?php echo $tipo_mensaje; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="grupo-formulario-canva">
                <label for="nombre">Nombre(s) *</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Ej. Juan">
            </div>

            <div class="grupo-formulario-canva">
                <label for="apellido">Apellido(s) *</label>
                <input type="text" id="apellido" name="apellido" required placeholder="Ej. Pérez Gómez">
            </div>

            <div class="grupo-formulario-canva">
                <label for="curp">CURP</label>
                <input type="text" id="curp" name="curp" placeholder="18 caracteres numéricos y letras" style="text-transform: uppercase;">
            </div>

            <div class="grupo-formulario-canva">
                <label for="telefono">Teléfono de Contacto</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Ej. 3312345678">
            </div>

            <button type="submit" class="btn-guardar-canva">Guardar Propietario</button>
        </form>
    </div>

</body>
</html>