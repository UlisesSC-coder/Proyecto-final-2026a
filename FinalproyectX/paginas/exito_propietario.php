<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['ultimo_registro'])) {
    header("Location: alta_propietario.php");
    exit();
}

$datos = $_SESSION['ultimo_registro'];
unset($_SESSION['ultimo_registro']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Registro Exitoso</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
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
        <div class="exito-icono-contenedor">
            <span class="exito-icono">🎉</span>
        </div>
        
        <h2 class="exito-titulo">¡Registro Completado con Éxito!</h2>
        <p class="exito-subtitulo">El propietario se ha dado de alta de forma oficial en el sistema catastral.</p>

        <div class="recibo-container">
            <div class="recibo-encabezado">
                <h3 class="recibo-titulo-seccion">Resumen del Registro</h3>
                <div class="recibo-badge-contenedor">
                    <span class="recibo-id-texto">ID ASIGNADO:</span>
                    <span class="badge-id">#<?php echo $datos['id_propietario']; ?></span>
                </div>
            </div>

            <table class="tabla-resumen">
                <tr>
                    <td>Nombre Completo:</td>
                    <td><?php echo htmlspecialchars($datos['nombre'] . ' ' . $datos['apellido_paterno'] . ' ' . $datos['apellido_materno']); ?></td>
                </tr>
                <tr>
                    <td>RFC:</td>
                    <td><?php echo htmlspecialchars(!empty($datos['rfc']) ? $datos['rfc'] : 'No registrado'); ?></td>
                </tr>
                <tr>
                    <td>CURP:</td>
                    <td><?php echo htmlspecialchars(!empty($datos['curp']) ? $datos['curp'] : 'No registrado'); ?></td>
                </tr>
                <tr>
                    <td>Fecha de Nacimiento:</td>
                    <td><?php echo htmlspecialchars($datos['fecha_nacimiento']); ?></td>
                </tr>
                <tr>
                    <td>Teléfono:</td>
                    <td><?php echo htmlspecialchars(!empty($datos['telefono']) ? $datos['telefono'] : 'No registrado'); ?></td>
                </tr>
                <tr>
                    <td>Correo Electrónico:</td>
                    <td><?php echo htmlspecialchars(!empty($datos['correo_electronico']) ? $datos['correo_electronico'] : 'No registrado'); ?></td>
                </tr>
                <tr>
                    <td>Domicilio Particular:</td>
                    <td><?php echo htmlspecialchars(!empty($datos['domicilio']) ? $datos['domicilio'] : 'No registrado'); ?></td>
                </tr>
                <tr>
                    <td>Fecha de Alta en Sistema:</td>
                    <td><?php echo htmlspecialchars($datos['fecha_registro']); ?></td>
                </tr>
            </table>
        </div>

        <div class="recibo-botonera">
            <a href="alta_propietario.php" class="btn-accion-recibo">Registrar Nuevo Propietario</a>
        </div>
    </div>

</body>
</html>