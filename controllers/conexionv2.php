<?php
    function conectar() {
        $enlace = mysqli_connect("localhost","root", "root","actividad_1");
        if ($enlace->connect_error) {
            die('Error: ' . $enlace->connect_error);
        }
//        echo "conexion exitosa xD";
        return $enlace;
    }