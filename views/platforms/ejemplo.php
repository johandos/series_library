<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conexion BD</title>
</head>
<body>
<?php
$enlace = mysqli_connect("localhost","root", "root","actividad_1");

if (!$enlace) {
    die("No pudo conectarse a la BD" . mysqli_error());
}
echo "conexion exitosa";
mysqli_close($enlace);
?>
</body>

</html>