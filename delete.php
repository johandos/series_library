<?php

    require_once("util/conexionDB/conexion.php");
    $conn = conectar();
    $id = $_GET['id'];
    $sql = "DELETE FROM platform WHERE id_platform='$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        Header("Location: indexTest.php");
    } else {
        echo $query;
    }

