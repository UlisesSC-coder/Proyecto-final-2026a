<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    exit();
}

include("../conexion_hosting_ulises.php");

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
    exit();
}

try {
    $sql = "SELECT id_propietario, nombre, apellido_paterno, apellido_materno, rfc, curp, domicilio, telefono, correo_electronico, fecha_nacimiento, fecha_registro 
            FROM Propietarios 
            WHERE nombre LIKE :q 
               OR apellido_paterno LIKE :q 
               OR apellido_materno LIKE :q 
               OR rfc LIKE :q 
               OR curp LIKE :q 
            ORDER BY id_propietario ASC";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute([':q' => "%$q%"]);
    $propietarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($propietarios) > 0) {
        foreach ($propietarios as $p) {
            echo "<tr style='border-bottom: 1px solid #edf2f7; transition: background 0.2s;' onmouseover=\"this.style.backgroundColor='#f7fafc'\" onmouseout=\"this.style.backgroundColor='transparent'\">";
            echo "<td style='padding: 14px; font-weight: bold; color: #00c4cc;'>#" . $p['id_propietario'] . "</td>";
            echo "<td style='padding: 14px; color: #0e1217;'>" . htmlspecialchars($p['nombre'] . ' ' . $p['apellido_paterno'] . ' ' . $p['apellido_materno']) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568; font-family: monospace;'>" . htmlspecialchars($p['rfc']) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568; font-family: monospace;'>" . htmlspecialchars($p['curp']) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568;'>| " . htmlspecialchars($p['domicilio']) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568;'>" . htmlspecialchars($p['telefono']) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568;'>| " . htmlspecialchars($p['correo_electronico']) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568; white-space: nowrap;'>" . htmlspecialchars($p['fecha_nacimiento']) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568; white-space: nowrap;'>" . htmlspecialchars($p['fecha_registro']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo '<tr><td colspan="9" style="padding: 30px; text-align: center; color: #e74c3c; font-weight: 600;">❌ No se encontraron propietarios que coincidan con la búsqueda.</td></tr>';
    }
} catch (PDOException $e) {
    echo '<tr><td colspan="9" style="padding: 30px; text-align: center; color: red;">Error en la consulta.</td></tr>';
}
?>