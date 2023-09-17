<?php

namespace models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Restriction {
    private $id;
    private $recomendations;
    private $connection;

    public function getId()
    {
        return $this->id;
    }

    public function getRecomendations()
    {
        return $this->recomendations;
    }

    public function __construct($id = null, $recomendations = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
        if ($recomendations !== null) {
            $this->recomendations = $recomendations;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM restriction");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Restriction(
                $item['id_restrict'],
                $item['recomendations']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData;
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT * FROM restriction WHERE id_restrict = $id");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Restriction(
                $item['id_restrict'],
                $item['recomendations']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData[0] ?? null;
    }

    public function insert($recomendations)
    {
        $restrictionCreated = false;
        $query = "INSERT INTO restriction (recomendations) VALUES (?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $recomendations);
        if ($stmt->execute()) {
            $restrictionCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $restrictionCreated;
    }

    public function update($id, $recomendations)
    {
        $restrictionUpdated = false;
        $query = "UPDATE restriction SET recomendations = ? WHERE id_restrict = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $recomendations, $id);
        if ($stmt->execute()) {
            $restrictionUpdated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $restrictionUpdated;
    }

    public function delete($id)
    {
        $restrictionDeleted = false;
        $stmt = $this->connection->prepare("DELETE FROM restriction WHERE id_restrict = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $restrictionDeleted = true;
        }
        $stmt->close();
        $this->connection->close();
        return $restrictionDeleted;
    }
}
