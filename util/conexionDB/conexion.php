<?php

namespace util;

class conexion{
    function conectar() {
        $enlace = mysqli_connect("127.0.0.1","root", "","series_test");
        if ($enlace->connect_error) {
            die('Error: ' . $enlace->connect_error);
        }
//        echo "conexion exitosa xD";
        return $enlace;
    }
}