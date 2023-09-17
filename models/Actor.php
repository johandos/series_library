<?php

namespace models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Actor {
    private $id;
    private $name;
    private $surname;
    private $dateOfBirth;
    private $nationality;
    private $serieId;
    private $connection;

    public function __construct($id = null, $name = null, $surname = null, $dateOfBirth = null, $nationality = null, $serieId = null)
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
        if ($dateOfBirth !== null) {
            $this->dateOfBirth = $dateOfBirth;
        }
        if ($nationality !== null) {
            $this->nationality = $nationality;
        }
        if ($serieId !== null) {
            $this->serieId = $serieId;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM actor");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Actor(
                $item['id_act'],
                $item['act_name'],
                $item['act_surname'],
                $item['act_date_birth'],
                $item['act_nacionality'],
                $item['id_serie']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData;
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT * FROM actor WHERE id_act = $id");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Actor(
                $item['id_act'],
                $item['act_name'],
                $item['act_surname'],
                $item['act_date_birth'],
                $item['act_nacionality'],
                $item['id_serie']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData[0] ?? null;
    }

    public function insert($name, $surname, $dateOfBirth, $nationality, $serieId)
    {
        $actorCreated = false;
        $query = "INSERT INTO actor (act_name, act_surname, act_date_birth, act_nacionality, id_serie) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssssi", $name, $surname, $dateOfBirth, $nationality, $serieId);
        if ($stmt->execute()) {
            $actorCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $actorCreated;
    }

    public function update($id, $name, $surname, $dateOfBirth, $nationality, $serieId)
    {
        $actorUpdated = false;
        $query = "UPDATE actor SET act_name = ?, act_surname = ?, act_date_birth = ?, act_nacionality = ?, id_serie = ? WHERE id_act = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssssii", $name, $surname, $dateOfBirth, $nationality, $serieId, $id);
        if ($stmt->execute()) {
            $actorUpdated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $actorUpdated;
    }

    public function delete($id)
    {
        $actorDeleted = false;
        $stmt = $this->connection->prepare("DELETE FROM actor WHERE id_act = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $actorDeleted = true;
        }
        $stmt->close();
        $this->connection->close();
        return $actorDeleted;
    }

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

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function getSerieId()
    {
        return $this->serieId;
    }
}
