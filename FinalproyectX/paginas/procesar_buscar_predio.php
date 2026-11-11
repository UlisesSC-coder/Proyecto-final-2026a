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
    $sql = "SELECT clave_castral, id_propietario, tipo_propiedad, superficie_terreno, superficie_construccion, colindancias, estatus, valor_castral, ubicacion_domicilio 
            FROM Predios 
            WHERE clave_castral LIKE :q 
               OR ubicacion_domicilio LIKE :q 
               OR estatus LIKE :q 
            ORDER BY clave_castral ASC";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute([':q' => "%$q%"]);
    $predios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($predios) > 0) {
        foreach ($predios as $p) {
            echo "<tr style='border-bottom: 1px solid #edf2f7; transition: background 0.2s;' onmouseover=\"this.style.backgroundColor='#f7fafc'\" onmouseout=\"this.style.backgroundColor='transparent'\">";
            echo "<td style='padding: 14px; font-weight: bold; color: #00c4cc;'>#" . $p['clave_castral'] . "</td>";
            echo "<td style='padding: 14px; color: #4a5568; font-weight: bold;'>#" . $p['id_propietario'] . "</td>";
            echo "<td style='padding: 14px; color: #0e1217;'>" . htmlspecialchars($p['tipo_propiedad']) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568;'>| " . htmlspecialchars($p['superficie_terreno']) . " m²</td>";
            echo "<td style='padding: 14px; color: #4a5568;'>| " . htmlspecialchars($p['superficie_construccion']) . " m²</td>";
            echo "<td style='padding: 14px; color: #4a5568;'>| " . htmlspecialchars($p['colindancias']) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568;'>";
            echo "<span style='padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: 600; background-color: #e6fffa; color: #00a3a4;'>" . htmlspecialchars($p['estatus']) . "</span>";
            echo "</td>";
            echo "<td style='padding: 14px; color: #0e1217; font-weight: 600;'>$" . number_format($p['valor_castral'], 2) . "</td>";
            echo "<td style='padding: 14px; color: #4a5568;'>| " . htmlspecialchars($p['ubicacion_domicilio']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo '<tr><td colspan="9" style="padding: 30px; text-align: center; color: #e74c3c; font-weight: 600;">❌ No se encontraron predios que coincidan con la búsqueda.</td></tr>';
    }
} catch (PDOException $e) {
    echo '<tr><td colspan="9" style="padding: 30px; text-align: center; color: red;">Error en la consulta.</td></tr>';
}
?>