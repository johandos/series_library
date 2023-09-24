<?php

namespace Models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Director {
    private $id;
    private $name;
    private $surname;
    private $nationality;
    private $dateBirth;
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
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    public function __construct($id = null, $name = null, $surname = null, $nationality = null, $dateBirth = null)
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
        if ($dateBirth !== null) {
            $this->dateBirth = $dateBirth;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM director WHERE dir_status = 1");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Director(
                $item['id_dir'],
                $item['dir_name'],
                $item['dir_surname'],
                $item['dir_nacionality'],
                $item['date_birth']
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
                $item['dir_nacionality'],
                $item['date_birth']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData[0] ?? null;
    }

    public function insert($name, $surname, $nationality, $dateBirth)
    {
        $directorCreated = false;
        $query = "INSERT INTO director (dir_name, dir_surname, dir_nacionality, date_birth) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssss", $name, $surname, $nationality, $dateBirth);
        if ($stmt->execute()) {
            $directorCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $directorCreated;
    }

    public function update($id, $name, $surname, $nationality, $dateBirth)
    {
        $directorUpdated = false;
        $query = "UPDATE director SET dir_name = ?, dir_surname = ?, dir_nacionality = ?, date_birth = ? WHERE id_dir = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssi", $name, $surname, $nationality, $dateBirth, $id);
        if ($stmt->execute()) {
            $directorUpdated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $directorUpdated;
    }

    public function delete($id)
    {
        $directorDelete = false;
        $query = "UPDATE director SET dir_status = false WHERE id_dir = $id";
        $stmt = $this->connection->prepare($query);
        if ($stmt->execute()) {
            $directorDelete = true;
        }
        $stmt->close();
        $this->connection->close();
        return $directorDelete;
    }
}
