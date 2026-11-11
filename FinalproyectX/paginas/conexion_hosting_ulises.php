<?php
//Declaramos las 4 variables para la conexión a la Base de Datos
$servername = "sql305.infinityfree.com";    // ----- Servidor donde está la BD
$username = "if0_40967812";           // ----- Usuario para entrar a la BD
$password = "AGENTElol008";        // ----- Password para entrar a la BD
$BaseDatos = "if0_40967812_catastro";     // ----- Nombre de tu base de datos

//En un bloque try - catch escribimos la línea de conexión *******
try {
    // Creamos la variable $conn que usaremos en todo el proyecto web
    $conn = new PDO("mysql:host=$servername;dbname=$BaseDatos", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Imprimimos en pantalla si nos pudimos conectar a la Base de Datos
   // echo "<div align='center'><h1>Si me conecté</h1>
	//<br>
	//<h1>Ulises Sánchez Camarena</h1>
	
	//</div>";
}
catch(PDOException $e)
{
    //Imprimimos en pantalla cuando NO nos pudimos conectar a la Base de Datos
    echo "<div align='center'><h1>Noooo me conecté: </h1></div> " . $e->getMessage();
}
?>
