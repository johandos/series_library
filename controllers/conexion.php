<?php
    function conectar() {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_password = 'root';
        $db_db = 'actividad_1';
        $db_port = 3306;

        $mysqli = @new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_db,
            $db_port
        );
        if ($mysqli->connect_error) {
            die('Error: ' . $mysqli->connect_error);
        }
        return $mysqli;
    }