<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); exit();
}
include("../conexion_hosting_ulises.php");

try {
    $stmt = $conn->query("SELECT * FROM Predios ORDER BY clave_castral ASC");
    $predios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catastro - Eliminar Predio</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/confirmar_baja_predio.js?v=<?php echo time(); ?>" defer></script>
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

    <div class="tabla-container-canva" style="width: 98%; max-width: 1600px; margin: 40px auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        <h2>Baja de Registro de Predios</h2>
        <p style="color: #e74c3c; font-weight: 500;">⚠️ Advertencia: Al presionar "Eliminar" e interceptar la confirmación, la Ficha Catastral será purgada definitivamente del sistema.</p>
        <br>
        <div style="overflow-x: auto;">
            <table class="tabla-resumen" style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="background-color: #fdf2f2; border-bottom: 2px solid #f5c6cb;">
                        <th style="padding: 12px;">Clave Catastral</th>
                        <th style="padding: 12px;">ID Prop.</th>
                        <th style="padding: 12px;">Tipo Propiedad</th>
                        <th style="padding: 12px;">Sup. Terreno</th>
                        <th style="padding: 12px;">Sup. Const.</th>
                        <th style="padding: 12px;">Valor Catastral</th>
                        <th style="padding: 12px;">Colindancias</th>
                        <th style="padding: 12px;">Ubicación / Domicilio</th>
                        <th style="padding: 12px;">Estatus</th>
                        <th style="padding: 12px; text-align: center;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($predios as $p): ?>
                        <tr style="border-bottom: 1px solid #edf2f7;">
                            <td style="padding: 12px; font-weight: bold; color: #e74c3c;">#<?php echo $p['clave_castral']; ?></td>
                            <td style="padding: 12px; font-weight: bold;">#<?php echo $p['id_propietario']; ?></td>
                            <td style="padding: 12px;"><?php echo htmlspecialchars($p['tipo_propiedad']); ?></td>
                            <td style="padding: 12px; white-space: nowrap;"><?php echo htmlspecialchars($p['superficie_terreno']); ?> m²</td>
                            <td style="padding: 12px; white-space: nowrap;"><?php echo htmlspecialchars($p['superficie_construccion']); ?> m²</td>
                            <td style="padding: 12px; font-weight: 600; white-space: nowrap;">$<?php echo number_format($p['valor_castral'], 2); ?></td>
                            <td style="padding: 12px; max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo htmlspecialchars($p['colindancias']); ?>">
                                <?php echo htmlspecialchars($p['colindancias']); ?>
                            </td>
                            <td style="padding: 12px; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="<?php echo htmlspecialchars($p['ubicacion_domicilio']); ?>">
                                <?php echo htmlspecialchars($p['ubicacion_domicilio']); ?>
                            </td>
                            <td style="padding: 12px;">
                                <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; background: #fee2e2; color: #991b1b;">
                                    <?php echo htmlspecialchars($p['estatus']); ?>
                                </span>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <button type="button" onclick="interceptarBajaPredio(<?php echo $p['clave_castral']; ?>);" style="background: #e74c3c; color: white; padding: 6px 14px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>