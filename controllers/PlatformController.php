<?php
require_once('../models/Platform.php');

    function initConnectionDB()
    {
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

    function listPlatforms()
    {

        $mysqli = initConnectionDB();
        $platformList = $mysqli->query("SELECT * FROM platforms");

        $platformObjectArray = [];
        foreach ($platformList as $platformItem) {
            $platformObject = new Platform($platformItem['id'], $platformItem['name']);
            array_push($platformObjectArray, $platformObject);
        }
        $mysqli->close();

        return $platformObjectArray;

    }

?>