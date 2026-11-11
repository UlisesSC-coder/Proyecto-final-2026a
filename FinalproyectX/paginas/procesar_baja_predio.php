<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php"); exit();
}
include("../conexion_hosting_ulises.php");

$clave = isset($_GET['clave']) ? intval($_GET['clave']) : 0;

if ($clave > 0) {
    try {
        // 1. Recuperar los datos íntegros antes de borrarlos para preservarlos en el éxito
        $stmtSelect = $conn->prepare("SELECT * FROM Predios WHERE clave_castral = :clave");
        $stmtSelect->execute([':clave' => $clave]);
        $predioBorrando = $stmtSelect->fetch(PDO::FETCH_ASSOC);

        if ($predioBorrando) {
            // 2. Ejecutar la remoción física
            $stmtDelete = $conn->prepare("DELETE FROM Predios WHERE clave_castral = :clave");
            $stmtDelete->execute([':clave' => $clave]);

            // 3. Serializar todo el contenido a la sesión de éxito
            $_SESSION['predio_eliminado_datos'] = $predioBorrando;
            header("Location: exito_baja_predio.php"); exit();
        } else {
            echo "El predio seleccionado no existe."; exit();
        }
    } catch (PDOException $e) {
        echo "Error al procesar la baja: " . $e->getMessage(); exit();
    }
} else {
    header("Location: baja_predio.php"); exit();
}
?>