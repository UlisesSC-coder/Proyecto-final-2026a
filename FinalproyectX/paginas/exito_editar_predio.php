<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['predio_editado'])) {
    header("Location: modificar_predio.php"); exit();
}
$datos = $_SESSION['predio_editado'];
unset($_SESSION['predio_editado']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualización Exitosa</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
</head>
<body class="dashboard-page">
    <div class="form-container-canva" style="margin-top: 60px; text-align: center;">
        <div style="font-size: 50px;">🏢</div>
        <h2>¡Ficha Catastral Actualizada!</h2>
        <p>Los datos cartográficos del predio se guardaron correctamente.</p>
        <br>
        <div class="recibo-container" style="text-align: left; background: #f8f9fa; padding: 20px; border-radius: 8px;">
            <p><strong>Clave Catastral:</strong> #<?php echo htmlspecialchars($datos['clave_castral']); ?></p>
            <p><strong>ID Propietario Relacionado:</strong> #<?php echo htmlspecialchars($datos['id_propietario']); ?></p>
            <p><strong>Tipo de Propiedad:</strong> <?php echo htmlspecialchars($datos['tipo_propiedad']); ?></p>
            <p><strong>Superficie Terreno:</strong> <?php echo htmlspecialchars($datos['superficie_terreno']); ?> m²</p>
            <p><strong>Superficie Construcción:</strong> <?php echo htmlspecialchars($datos['superficie_construccion']); ?> m²</p>
            <p><strong>Valor Catastral:</strong> $<?php echo number_format($datos['valor_castral'], 2); ?></p>
            <p><strong>Ubicación / Domicilio:</strong> <?php echo htmlspecialchars($datos['ubicacion_domicilio']); ?></p>
        </div>
        <br>
        <a href="modificar_predio.php" class="btn-guardar-canva" style="text-decoration:none; display:inline-block; background:#00c4cc;">Regresar al Panel</a>
    </div>
</body>
</html>