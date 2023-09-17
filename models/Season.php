<?php

namespace models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Season {
    private $id;
    private $info;
    private $chapters;
    private $seriesId;
    private $connection;

    public function __construct($id = null, $info = null, $chapters = null, $seriesId = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
        if ($info !== null) {
            $this->info = $info;
        }
        if ($chapters !== null) {
            $this->chapters = $chapters;
        }
        if ($seriesId !== null) {
            $this->seriesId = $seriesId;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM season");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Season(
                $item['id_season'],
                $item['season_info'],
                $item['season_chapters'],
                $item['id_ser']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData;
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT * FROM season WHERE id_season = $id");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Season(
                $item['id_season'],
                $item['season_info'],
                $item['season_chapters'],
                $item['id_ser']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData[0] ?? null;
    }

    public function insert($info, $chapters, $seriesId)
    {
        $seasonCreated = false;
        $query = "INSERT INTO season (season_info, season_chapters, id_ser) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sii", $info, $chapters, $seriesId);
        if ($stmt->execute()) {
            $seasonCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $seasonCreated;
    }

    public function update($id, $info, $chapters, $seriesId)
    {
        $seasonUpdated = false;
        $query = "UPDATE season SET season_info = ?, season_chapters = ?, id_ser = ? WHERE id_season = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("siii", $info, $chapters, $seriesId, $id);
        if ($stmt->execute()) {
            $seasonUpdated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $seasonUpdated;
    }

    public function delete($id)
    {
        $seasonDeleted = false;
        $stmt = $this->connection->prepare("DELETE FROM season WHERE id_season = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $seasonDeleted = true;
        }
        $stmt->close();
        $this->connection->close();
        return $seasonDeleted;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function getChapters()
    {
        return $this->chapters;
    }

    public function getSeriesId()
    {
        return $this->seriesId;
    }
}
