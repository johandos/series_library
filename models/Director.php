<?php

namespace models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Director {
    private $id;
    private $name;
    private $surname;
    private $nationality;
    private $connection;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function __construct($id = null, $name = null, $surname = null, $nationality = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
        if ($name !== null) {
            $this->name = $name;
        }
        if ($surname !== null) {
            $this->surname = $surname;
        }
        if ($nationality !== null) {
            $this->nationality = $nationality;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM director");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Director(
                $item['id_dir'],
                $item['dir_name'],
                $item['dir_surname'],
                $item['dir_nacionality']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData;
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT * FROM director WHERE id_dir = $id");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Director(
                $item['id_dir'],
                $item['dir_name'],
                $item['dir_surname'],
                $item['dir_nacionality']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData[0] ?? null;
    }

    public function insert($name, $surname, $nationality)
    {
        $directorCreated = false;
        $query = "INSERT INTO director (dir_name, dir_surname, dir_nacionality) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sss", $name, $surname, $nationality);
        if ($stmt->execute()) {
            $directorCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $directorCreated;
    }

    public function update($id, $name, $surname, $nationality)
    {
        $directorUpdated = false;
        $query = "UPDATE director SET dir_name = ?, dir_surname = ?, dir_nacionality = ? WHERE id_dir = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssi", $name, $surname, $nationality, $id);
        if ($stmt->execute()) {
            $directorUpdated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $directorUpdated;
    }

    public function delete($id)
    {
        $directorDeleted = false;
        $stmt = $this->connection->prepare("DELETE FROM director WHERE id_dir = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $directorDeleted = true;
        }
        $stmt->close();
        $this->connection->close();
        return $directorDeleted;
    }
}
