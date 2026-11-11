<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../conexion_hosting_ulises.php");

echo "<h2>Intentando activar el AUTO_INCREMENT en clave_castral...</h2>";

try {
    // 1. Convertir la columna a tipo INT por si estuviera como texto
    $sql1 = "ALTER TABLE Predios MODIFY COLUMN clave_castral INT NOT NULL";
    $conn->exec($sql1);
    echo "<p style='color: green;'>✓ Paso 1: Columna configurada como INT correctamente.</p>";

    // 2. Aplicar el AUTO_INCREMENT de forma forzada por SQL
    $sql2 = "ALTER TABLE Predios MODIFY COLUMN clave_castral INT NOT NULL AUTO_INCREMENT";
    $conn->exec($sql2);
    echo "<p style='color: green;'>✓ Paso 2: ¡AUTO_INCREMENT activado con éxito!</p>";
    
    echo "<h3 style='color: blue;'>¡Listo, ya quedó arreglado! Ya puedes borrar este archivo de tu hosting y usar la versión de alta de predios que gustes.</h3>";

} catch (PDOException $e) {
    echo "<p style='color: red;'>❌ Error al modificar la tabla: " . $e->getMessage() . "</p>";
    echo "<p><b>Nota:</b> Si te dice que hay un error de 'Duplicate entry', es porque ya tienes filas con claves repetidas o en blanco (como el 0 que vimos en la foto). Tendrás que ir a phpMyAdmin, vaciar o borrar esos registros de prueba viejos de la tabla Predios y volver a cargar esta página.</p>";
}
?>