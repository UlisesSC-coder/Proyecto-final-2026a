<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php?rastreo=bloqueado");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catastro - Buscar Predio</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script>
        function buscarPredio(valor) {
            const contenedor = document.getElementById("resultado_busqueda");
            if (valor.trim() === "") {
                contenedor.innerHTML = '<tr><td colspan="9" style="padding: 30px; text-align: center; color: #a0aec0;">Escribe en la barra para buscar un predio...</td></tr>';
                return;
            }
            
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "procesar_buscar_predio.php?q=" + encodeURIComponent(valor), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    contenedor.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
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
        <h2 style="color: #0e1217; margin-bottom: 10px;">Búsqueda Inteligente de Predios</h2>
        <p style="color: #4a5568; margin-bottom: 25px;">Localiza propiedades inmuebles de forma instantánea buscando por clave catastral, ubicación o estatus.</p>

        <div style="margin-bottom: 30px;">
            <input type="text" id="input_buscar" placeholder="🔍 Escribe la clave catastral, ubicación o estatus del inmueble..." onkeyup="buscarPredio(this.value);" style="width: 100%; padding: 14px 20px; font-size: 1.1rem; border: 1px solid #dcdfe4; border-radius: 8px; box-sizing: border-box; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#00c4cc'" onblur="this.style.borderColor='#dcdfe4'">
        </div>

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
                <tbody id="resultado_busqueda">
                    <tr>
                        <td colspan="9" style="padding: 30px; text-align: center; color: #a0aec0;">Escribe en la barra para buscar un predio...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>