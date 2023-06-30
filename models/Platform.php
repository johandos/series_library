<?php

namespace models;

require_once __DIR__ . '/../util/conexionDB/conexion.php';
use util\conexion;

class Platform{
    private $id;
    private $name;

    public function __construct($id_platform = null, $plat_name = null)
    {
        if($id_platform != null){
            $this->id=$id_platform;
        }
        if($plat_name != null){
            $this->name=$plat_name;
        }
    }

    public function getAll(){
        $conection = new conexion();
        $mysqli = $conection->conectar();
        $query = $mysqli->query("SELECT * FROM platform");
        $listData = [];
        foreach ($query as $item){
            $itemObject = new Platform($item['id_platform'], $item['plat_name']);
            $listData[] = $itemObject;
        }
        $mysqli->close();
        return $listData;
    }
    public function findOne($id){
        $conection = new conexion();
        $mysqli = $conection->conectar();
        $query = $mysqli->query("SELECT * FROM platform WHERE id_platform = $id");
        $listData = [];
        foreach ($query as $item){
            $itemObject = new Platform($item['id_platform'], $item['plat_name']);
            $listData[] = $itemObject;
        }
        $mysqli->close();
        return $listData;
    }

    function insert($name)
    {
        $platformCreated = false;
        $conection = new conexion();
        $mysqli = $conection->conectar();
        if($resultInsert = $mysqli->query("INSERT INTO platform (plat_name) VALUES ('$name')")){
            $platformCreated = true;
        }
        $mysqli->close();
        return $platformCreated;
    }

    function updated($id, $name)
    {
        $platformCreated = false;
        $conection = new conexion();
        $mysqli = $conection->conectar();
        if($resultInsert = $mysqli->query("UPDATE platform SET plat_name='$name' WHERE id_platform=$id")){
            $platformCreated = true;
        }
        $mysqli->close();
        return $platformCreated;
    }


        /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}




