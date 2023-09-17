<?php

namespace Models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Gender {
    private $id;
    private $description;
    private $connection;

    public function __construct($id = null, $description = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
        if ($description !== null) {
            $this->description = $description;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM gendre");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Gender(
                $item['id_gen'],
                $item['gen_descrip']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData;
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT * FROM gendre WHERE id_gen = $id");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Gender(
                $item['id_gen'],
                $item['gen_descrip']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData[0] ?? null;
    }

    public function insert($description)
    {
        $gendreCreated = false;
        $query = "INSERT INTO gendre (gen_descrip) VALUES (?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $description);
        if ($stmt->execute()) {
            $gendreCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $gendreCreated;
    }

    public function update($id, $description)
    {
        $gendreUpdated = false;
        $query = "UPDATE gendre SET gen_descrip = ? WHERE id_gen = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $description, $id);
        if ($stmt->execute()) {
            $gendreUpdated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $gendreUpdated;
    }

    public function delete($id)
    {
        $gendreDeleted = false;
        $stmt = $this->connection->prepare("DELETE FROM gendre WHERE id_gen = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $gendreDeleted = true;
        }
        $stmt->close();
        $this->connection->close();
        return $gendreDeleted;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
