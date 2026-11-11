<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado"); exit();
}
include("../conexion_hosting_ulises.php");

try {
    $stmt = $conn->query("SELECT * FROM Propietarios ORDER BY id_propietario ASC");
    $propietarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage(); exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catastro - Modificar Propietario</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script>
        function confirmarEdicion(id) {
            if (confirm("¿Estás seguro de que deseas editar al propietario con ID #" + id + "?")) {
                window.location.href = "formulario_editar_propietario.php?id=" + id;
            }
        }
    </script>
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

    <div class="tabla-container-canva" style="width: 95%; max-width: 1400px; margin: 40px auto; background: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
        <h2>Actualización de Propietarios</h2>
        <p>Selecciona el registro que deseas modificar haciendo clic en el botón de la última columna.</p>
        <br>
        <div style="overflow-x: auto;">
            <table class="tabla-resumen" style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #f8f9fa; border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 12px;">ID</th>
                        <th style="padding: 12px;">Nombre Completo</th>
                        <th style="padding: 12px;">RFC</th>
                        <th style="padding: 12px;">CURP</th>
                        <th style="padding: 12px;">Domicilio</th>
                        <th style="padding: 12px;">Teléfono</th>
                        <th style="padding: 12px;">Correo</th>
                        <th style="padding: 12px; text-align: center;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($propietarios as $p): ?>
                        <tr style="border-bottom: 1px solid #edf2f7;">
                            <td style="padding: 12px; font-weight: bold; color: #00c4cc;">#<?php echo $p['id_propietario']; ?></td>
                            <td style="padding: 12px;"><?php echo htmlspecialchars($p['nombre'] . ' ' . $p['apellido_paterno'] . ' ' . $p['apellido_materno']); ?></td>
                            <td style="padding: 12px; font-family: monospace;"><?php echo htmlspecialchars($p['rfc']); ?></td>
                            <td style="padding: 12px; font-family: monospace;"><?php echo htmlspecialchars($p['curp']); ?></td>
                            <td style="padding: 12px;"><?php echo htmlspecialchars($p['domicilio']); ?></td>
                            <td style="padding: 12px;"><?php echo htmlspecialchars($p['telefono']); ?></td>
                            <td style="padding: 12px;"><?php echo htmlspecialchars($p['correo_electronico']); ?></td>
                            <td style="padding: 12px; text-align: center;">
                                <button type="button" onclick="confirmarEdicion(<?php echo $p['id_propietario']; ?>);" style="background: #00c4cc; color: white; padding: 6px 14px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Editar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>