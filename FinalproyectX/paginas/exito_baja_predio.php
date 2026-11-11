<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['predio_eliminado_datos'])) {
    header("Location: baja_predio.php"); exit();
}
$datosEliminados = $_SESSION['predio_eliminado_datos'];
unset($_SESSION['predio_eliminado_datos']); // Limpiar sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Baja Exitosa - Predio</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
</head>
<body class="dashboard-page">

    <nav class="nav-container-canva">
        <ul class="main-menu-canva">
            <li class="menu-item-canva"><a href="menu.php">Inicio</a></li>
            <li class="menu-item-canva"><a href="#">Altas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="alta_propietario.php">Alta de Propietario</a></li>
                    <li><a href="alta_predio.php">Alta de Predio</a></li>
                </ul>
            </li>
            <li class="menu-item-canva"><a href="#">Consultas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="consulta_propietario.php">Ver Propietarios</a></li>
                    <li><a href="consulta_predio.php">Ver Predios</a></li>
                </ul>
            </li>
            <li class="menu-item-canva"><a href="#">Búsquedas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="buscar_propietario.php">Buscar Propietario</a></li>
                    <li><a href="buscar_predio.php">Buscar Predio</a></li>
                </ul>
            </li>
            <li class="menu-item-canva"><a href="#">Actualizaciones ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="modificar_propietario.php">Modificar Propietario</a></li>
                    <li><a href="modificar_predio.php">Modificar Predio</a></li>
                </ul>
            </li>
            <li class="menu-item-canva"><a href="#">Bajas ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="baja_propietario.php">Eliminar Propietario</a></li>
                    <li><a href="baja_predio.php">Eliminar Predio</a></li>
                </ul>
            </li>
            <li class="menu-item-canva"><a href="#">Reportes ▼</a>
                <ul class="dropdown-menu-canva">
                    <li><a href="reporte_propietarios.php">PDF Propietarios</a></li>
                    <li><a href="reporte_predios.php">PDF Predios Generales</a></li>
                    <li><a href="reporte_historial.php">PDF Cuenta Catastral</a></li>
                </ul>
            </li>
            <li class="menu-item-canva"><a href="../index.php" class="btn-salir-canva">Salir</a></li>
        </ul>
    </nav>

    <div class="form-container-canva" style="margin-top: 40px; text-align: center; border-top: 5px solid #e74c3c;">
        <div style="font-size: 50px;">🗑️</div>
        <h2 style="color: #c0392b;">¡Ficha Catastral Eliminada Exitosamente!</h2>
        <p>A continuación se muestra el expediente histórico de los datos borrados del sistema:</p>
        <br>
        <div class="recibo-container" style="text-align: left; background: #fff5f5; padding: 20px; border: 1px solid #f5c6cb; border-radius: 8px; max-width: 600px; margin: 0 auto; line-height: 1.8;">
            <p><strong>Clave Catastral Eliminada:</strong> <span style="color:#e74c3c; font-weight:bold;">#<?php echo htmlspecialchars($datosEliminados['clave_castral']); ?></span></p>
            <p><strong>ID Propietario Histórico:</strong> #<?php echo htmlspecialchars($datosEliminados['id_propietario']); ?></p>
            <p><strong>Tipo de Propiedad:</strong> <?php echo htmlspecialchars($datosEliminados['tipo_propiedad']); ?></p>
            <p><strong>Estatus que Tenía:</strong> <?php echo htmlspecialchars($datosEliminados['estatus']); ?></p>
            <p><strong>Superficie Terreno:</strong> <?php echo htmlspecialchars($datosEliminados['superficie_terreno']); ?> m²</p>
            <p><strong>Superficie Construcción:</strong> <?php echo htmlspecialchars($datosEliminados['superficie_construccion']); ?> m²</p>
            <p><strong>Valor Catastral Removido:</strong> $<?php echo number_format($datosEliminados['valor_castral'], 2); ?></p>
            <p><strong>Colindancias:</strong> <?php echo htmlspecialchars($datosEliminados['colindancias']); ?></p>
            <p><strong>Ubicación / Domicilio Registrado:</strong> <?php echo htmlspecialchars($datosEliminados['ubicacion_domicilio']); ?></p>
        </div>
        <br>
        <a href="baja_predio.php" class="btn-guardar-canva" style="text-decoration:none; display:inline-block; background:#e74c3c; width: auto; padding: 12px 30px;">Regresar al Panel de Bajas</a>
    </div>
</body>
</html>