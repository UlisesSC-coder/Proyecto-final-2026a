<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== 'SI') {
    header("Location: ../index.php"); exit();
}
include("../conexion_hosting_ulises.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre     = trim($_POST['nombre']);
    $paterno    = trim($_POST['apellido_paterno']);
    $materno    = trim($_POST['apellido_materno']);
    $rfc        = trim($_POST['rfc']);
    $curp       = trim($_POST['curp']);
    $domicilio  = trim($_POST['domicilio']);
    $telefono   = trim($_POST['telefono']);
    $correo     = trim($_POST['correo_electronico']);
    $nacimiento = trim($_POST['fecha_nacimiento']);

    try {
        $sql = "UPDATE Propietarios SET nombre=:nom, apellido_paterno=:pat, apellido_materno=:mat, rfc=:rfc, curp=:curp, domicilio=:dom, telefono=:tel, correo_electronico=:cor, fecha_nacimiento=:nac WHERE id_propietario=:id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nom'=>$nombre, ':pat'=>$paterno, ':mat'=>$materno, ':rfc'=>$rfc, ':curp'=>$curp,
            ':dom'=>$domicilio, ':tel'=>$telefono, ':cor'=>$correo, ':nac'=>$nacimiento, ':id'=>$id
        ]);

        $_SESSION['propietario_editado'] = [
            'id_propietario' => $id, 'nombre' => $nombre, 'apellido_paterno' => $paterno, 'apellido_materno' => $materno,
            'rfc' => $rfc, 'curp' => $curp, 'domicilio' => $domicilio, 'telefono' => $telefono, 'correo_electronico' => $correo, 'fecha_nacimiento' => $nacimiento
        ];
        header("Location: exito_editar_propietario.php"); exit();
    } catch (PDOException $e) { echo "Error: " . $e->getMessage(); exit(); }
}

$stmt = $conn->prepare("SELECT * FROM Propietarios WHERE id_propietario = :id");
$stmt->execute([':id' => $id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$p) { echo "No encontrado."; exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Propietario</title>
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <script src="../javascript/validacion_editar_propietario.js?v=<?php echo time(); ?>" defer></script>
</head>
<body class="dashboard-page">
    <div class="form-container-canva" style="margin-top: 40px;">
        <h2>Modificar Ficha de Propietario</h2>
        <br>
        <form id="formEditarProp" action="" method="POST" onsubmit="return validarEditarPropietario(event);">
            <div class="grupo-formulario-canva">
                <label>ID Propietario (No Modificable)</label>
                <input type="text" value="#<?php echo $id; ?>" class="input-bloqueado" readonly style="background-color: #f1f3f5; color: #718096; cursor: not-allowed; font-weight: bold;">
            </div>
            <div class="form-row-canva">
                <div class="grupo-formulario-canva">
                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($p['nombre']); ?>">
                </div>
                <div class="grupo-formulario-canva">
                    <label for="apellido_paterno">Apellido Paterno *</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?php echo htmlspecialchars($p['apellido_paterno']); ?>">
                </div>
            </div>
            <div class="form-row-canva">
                <div class="grupo-formulario-canva">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" value="<?php echo htmlspecialchars($p['apellido_materno']); ?>">
                </div>
                <div class="grupo-formulario-canva">
                    <label for="rfc">RFC *</label>
                    <input type="text" id="rfc" name="rfc" value="<?php echo htmlspecialchars($p['rfc']); ?>">
                </div>
            </div>
            <div class="form-row-canva">
                <div class="grupo-formulario-canva">
                    <label for="curp">CURP</label>
                    <input type="text" id="curp" name="curp" value="<?php echo htmlspecialchars($p['curp']); ?>">
                </div>
                <div class="grupo-formulario-canva">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($p['telefono']); ?>">
                </div>
            </div>
            <div class="grupo-formulario-canva">
                <label for="correo_electronico">Correo Electrónico</label>
                <input type="email" id="correo_electronico" name="correo_electronico" value="<?php echo htmlspecialchars($p['correo_electronico']); ?>">
            </div>
            <div class="grupo-formulario-canva">
                <label for="domicilio">Domicilio Particular</label>
                <input type="text" id="domicilio" name="domicilio" value="<?php echo htmlspecialchars($p['domicilio']); ?>">
            </div>
            <div class="grupo-formulario-canva">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($p['fecha_nacimiento']); ?>" style="width:100%; padding:12px; border:1px solid #dcdfe4; border-radius:8px; box-sizing:border-box;">
            </div>
            <br>
            <button type="submit" class="btn-guardar-canva">Guardar Cambios</button>
            <a href="modificar_propietario.php" style="display:block; text-align:center; margin-top:15px; color:#4a5568; text-decoration:none;">◀ Cancelar y Volver</a>
        </form>
    </div>
</body>
</html>