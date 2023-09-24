<?php

namespace Helper;

class Connection {
    function conectar() {
        $enlace = mysqli_connect("127.0.0.1","root", "","series_test1");
        if ($enlace->connect_error) {
            die('Error: ' . $enlace->connect_error);
        }

        // echo "conexion exitosa";
        return $enlace;
    }
}