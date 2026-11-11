<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI' || !isset($_SESSION['propietario_editado'])) {
    header("Location: modificar_propietario.php"); exit();
}
$datos = $_SESSION['propietario_editado'];
unset($_SESSION['propietario_editado']);
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
        <div style="font-size: 50px;">✨</div>
        <h2>¡Propietario Actualizado!</h2>
        <p>Los nuevos cambios se han guardado con éxito en la base de datos.</p>
        <br>
        <div class="recibo-container" style="text-align: left; background: #f8f9fa; padding: 20px; border-radius: 8px;">
            <p><strong>ID Propietario:</strong> #<?php echo htmlspecialchars($datos['id_propietario']); ?></p>
            <p><strong>Nombre Completo:</strong> <?php echo htmlspecialchars($datos['nombre'] . ' ' . $datos['apellido_paterno'] . ' ' . $datos['apellido_materno']); ?></p>
            <p><strong>RFC:</strong> <?php echo htmlspecialchars($datos['rfc']); ?></p>
            <p><strong>CURP:</strong> <?php echo htmlspecialchars($datos['curp']); ?></p>
            <p><strong>Domicilio:</strong> <?php echo htmlspecialchars($datos['domicilio']); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($datos['telefono']); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($datos['correo_electronico']); ?></p>
        </div>
        <br>
        <a href="modificar_propietario.php" class="btn-guardar-canva" style="text-decoration:none; display:inline-block; background:#00c4cc;">Regresar al Panel</a>
    </div>
</body>
</html>