<?php

namespace Models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Platform {
    private $id;
    private $name;
    private $connection;

    public function __construct($id = null, $name = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
        if ($name !== null) {
            $this->name = $name;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM platform");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Platform(
                $item['id_platform'],
                $item['plat_name']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData;
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT * FROM platform WHERE id_platform = $id");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Platform(
                $item['id_platform'],
                $item['plat_name']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData[0] ?? null;
    }

    public function insert($name)
    {
        $platformCreated = false;
        $query = "INSERT INTO platform (plat_name) VALUES (?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            $platformCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $platformCreated;
    }

    public function update($id, $name)
    {
        $platformUpdated = false;
        $query = "UPDATE platform SET plat_name = ? WHERE id_platform = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $name, $id);
        if ($stmt->execute()) {
            $platformUpdated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $platformUpdated;
    }

    public function delete($id)
    {
        $platformDeleted = false;
        $stmt = $this->connection->prepare("DELETE FROM platform WHERE id_platform = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $platformDeleted = true;
        }
        $stmt->close();
        $this->connection->close();
        return $platformDeleted;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
