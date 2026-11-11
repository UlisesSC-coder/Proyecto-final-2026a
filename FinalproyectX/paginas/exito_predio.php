<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['ultimo_predio'])) {
    header("Location: alta_predio.php");
    exit();
}

$datos = $_SESSION['ultimo_predio'];
unset($_SESSION['ultimo_predio']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Predio Registrado</title>
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
            <li class="menu-item-canva"><a href="../index.php" class="btn-salir-canva">Salir</a></li>
        </ul>
    </nav>

    <div class="form-container-canva">
        <div class="exito-icono-contenedor">
            <span class="exito-icono">🏢</span>
        </div>
        
        <h2 class="exito-titulo">¡Predio Registrado con Éxito!</h2>
        <p class="exito-subtitulo">El inmueble ha sido incorporado correctamente a la cartografía del sistema catastral.</p>

        <div class="recibo-container">
            <div class="recibo-encabezado">
                <h3 class="recibo-titulo-seccion">Resumen de la Ficha Catastral</h3>
                <div class="recibo-badge-contenedor">
                    <span class="recibo-id-texto">CLAVE:</span>
                    <span class="badge-id">#<?php echo htmlspecialchars($datos['clave_castral']); ?></span>
                </div>
            </div>

            <table class="tabla-resumen">
                <tr>
                    <td>ID Propietario Asignado:</td>
                    <td>#<?php echo htmlspecialchars($datos['id_propietario']); ?></td>
                </tr>
                <tr>
                    <td>Tipo de Propiedad:</td>
                    <td><?php echo htmlspecialchars($datos['tipo_propiedad']); ?></td>
                </tr>
                <tr>
                    <td>Estatus del Inmueble:</td>
                    <td><?php echo htmlspecialchars($datos['estatus']); ?></td>
                </tr>
                <tr>
                    <td>Superficie del Terreno:</td>
                    <td><?php echo htmlspecialchars($datos['superficie_terreno']); ?> m²</td>
                </tr>
                <tr>
                    <td>Superficie Construida:</td>
                    <td><?php echo htmlspecialchars($datos['superficie_construccion']); ?> m²</td>
                </tr>
                <tr>
                    <td>Valor Catastral Evaluado:</td>
                    <td>$<?php echo number_format($datos['valor_castral'], 2); ?></td>
                </tr>
                <tr>
                    <td>Colindancias del Predio:</td>
                    <td><?php echo htmlspecialchars($datos['colindancias']); ?></td>
                </tr>
                <tr>
                    <td>Ubicación / Domicilio:</td>
                    <td><?php echo htmlspecialchars($datos['ubicacion_domicilio']); ?></td>
                </tr>
            </table>
        </div>

        <div class="recibo-botonera">
            <a href="alta_predio.php" class="btn-accion-recibo">Registrar Nuevo Predio</a>
        </div>
    </div>

</body>
</html>