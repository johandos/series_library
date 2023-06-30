<?php
    require_once("util/conexionDB/conexion.php");
    $conn = conectar();
    $id = $_POST['id_platform'];
    $plat_name = $_POST['plat_name'];
    $sql = "UPDATE platform SET plat_name='$plat_name' WHERE id_platform='$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: indexTest.php");
    } else {
        echo $query;
    }
