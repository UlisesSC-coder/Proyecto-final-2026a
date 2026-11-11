<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado");
    exit();
}

include("../conexion_hosting_ulises.php");

try {
    $sql = "SELECT clave_castral, id_propietario, tipo_propiedad, superficie_terreno, superficie_construccion, colindancias, estatus, valor_castral, ubicacion_domicilio FROM Predios ORDER BY clave_castral ASC";
    $stmt = $conn->query($sql);
    $predios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Ver Predios</title>
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

    <div class="tabla-container-canva" style="width: 95%; max-width: 1400px; margin: 40px auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        <h2 style="color: #0e1217; margin-bottom: 10px;">Inventario de Predios</h2>
        <p style="color: #4a5568; margin-bottom: 25px;">Registro general de las propiedades inmuebles incorporadas a la cartografía del sistema catastral.</p>

        <div style="overflow-x: auto;">
            <table class="tabla-resumen" style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #f8f9fa; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 14px; color: #4a5568; font-weight: 600;">Clave Catastral</th>
                        <th style="padding: 14px; color: #4a5568; font-weight: 600;">ID Propietario</th>
                        <th style="padding: 14px; color: #4a5568; font-weight: 600;">Tipo Propiedad</th>
                        <th style="padding: 14px; color: #4a5568; font-weight: 600;">Sup. Terreno</th>
                        <th style="padding: 14px; color: #4a5568; font-weight: 600;">Sup. Construcción</th>
                        <th style="padding: 14px; color: #4a5568; font-weight: 600;">Colindancias</th>
                        <th style="padding: 14px; color: #4a5568; font-weight: 600;">Estatus</th>
                        <th style="padding: 14px; color: #4a5568; font-weight: 600;">Valor Catastral</th>
                        <th style="padding: 14px; color: #4a5568; font-weight: 600;">Ubicación / Domicilio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($predios) > 0): ?>
                        <?php foreach ($predios as $p): ?>
                            <tr style="border-bottom: 1px solid #edf2f7; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f7fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 14px; font-weight: bold; color: #00c4cc;">#<?php echo $p['clave_castral']; ?></td>
                                <td style="padding: 14px; color: #4a5568; font-weight: bold;">#<?php echo $p['id_propietario']; ?></td>
                                <td style="padding: 14px; color: #0e1217;"><?php echo htmlspecialchars($p['tipo_propiedad']); ?></td>
                                <td style="padding: 14px; color: #4a5568;"><?php echo htmlspecialchars($p['superficie_terreno']); ?> m²</td>
                                <td style="padding: 14px; color: #4a5568;"><?php echo htmlspecialchars($p['superficie_construccion']); ?> m²</td>
                                <td style="padding: 14px; color: #4a5568;"><?php echo htmlspecialchars($p['colindancias']); ?></td>
                                <td style="padding: 14px; color: #4a5568;">
                                    <span style="padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: 600; background-color: #e6fffa; color: #00a3a4;">
                                        <?php echo htmlspecialchars($p['estatus']); ?>
                                    </span>
                                </td>
                                <td style="padding: 14px; color: #0e1217; font-weight: 600;">$<?php echo number_format($p['valor_castral'], 2); ?></td>
                                <td style="padding: 14px; color: #4a5568;"><?php echo htmlspecialchars($p['ubicacion_domicilio']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" style="padding: 30px; text-align: center; color: #a0aec0;">No hay predios registrados en el sistema.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>