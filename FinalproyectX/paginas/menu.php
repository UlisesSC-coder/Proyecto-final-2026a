<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Menú Principal</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body class="dashboard-page">

    <nav class="navbar">
        <div class="navbar-brand">Catastro Estatal</div>
        <div class="navbar-user">
            <span>Bienvenido, <strong><?php echo $_SESSION['nombre_usuario']; ?></strong></span>
            <a href="../index.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>Panel de Control</h1>
            <p>Selecciona el módulo que deseas administrar hoy</p>
        </header>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Propietarios</h3>
                <p>Administración y registro de los datos generales de los titulares catastrales.</p>
                <a href="propietarios.php" class="btn-card">Gestionar Módulo</a>
            </div>

            <div class="dashboard-card">
                <h3>Predios</h3>
                <p>Control de terrenos, cuentas catastrales y su vinculación con los propietarios.</p>
                <a href="predios.php" class="btn-card">Gestionar Módulo</a>
            </div>
        </div>
    </div>

</body>
</html>