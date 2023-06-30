<?php
    require_once("util/conexionDB/conexion.php");
    $conn = conectar();
    $plat_name = $_POST['plat_name'];

    $sql = "INSERT INTO platform VALUES(null, '$plat_name')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        Header("Location: indexTest.php");
    }
