<?php
$host = "tu_host_de_mysql";
$usuario = "tu_usuario_de_mysql";
$contrasena = "tu_contrasena_de_mysql";
$base_de_datos = "tu_base_de_datos";

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>
