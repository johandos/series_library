<?php

namespace util;

class conexion{
    function conectar() {
        $enlace = mysqli_connect("20.5.0.5","root", "series_pw","series_test");
        if ($enlace->connect_error) {
            die('Error: ' . $enlace->connect_error);
        }
//        echo "conexion exitosa xD";
        return $enlace;
    }
}