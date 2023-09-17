<?php

namespace Models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Language {
    private $id;
    private $subtitle;
    private $isoCode;
    private $audio;
    private $connection;

    public function __construct($id = null, $subtitle = null, $isoCode = null, $audio = null)
    {
        if ($id !== null) {
            $this->id = $id;
        }
        if ($subtitle !== null) {
            $this->subtitle = $subtitle;
        }
        if ($isoCode !== null) {
            $this->isoCode = $isoCode;
        }
        if ($audio !== null) {
            $this->audio = $audio;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM lenguage");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Language(
                $item['id_leng'],
                $item['lenguage_sub'],
                $item['iso_code'],
                $item['lenguage_audio']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData;
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT * FROM lenguage WHERE id_leng = $id");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Language(
                $item['id_leng'],
                $item['lenguage_sub'],
                $item['iso_code'],
                $item['lenguage_audio']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData[0] ?? null;
    }

    public function insert($subtitle, $isoCode, $audio)
    {
        $lenguageCreated = false;
        $query = "INSERT INTO lenguage (lenguage_sub, iso_code, lenguage_audio) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sss", $subtitle, $isoCode, $audio);
        if ($stmt->execute()) {
            $lenguageCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $lenguageCreated;
    }

    public function update($id, $subtitle, $isoCode, $audio)
    {
        $lenguageUpdated = false;
        $query = "UPDATE lenguage SET lenguage_sub = ?, iso_code = ?, lenguage_audio = ? WHERE id_leng = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssi", $subtitle, $isoCode, $audio, $id);
        if ($stmt->execute()) {
            $lenguageUpdated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $lenguageUpdated;
    }

    public function delete($id)
    {
        $lenguageDeleted = false;
        $stmt = $this->connection->prepare("DELETE FROM lenguage WHERE id_leng = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $lenguageDeleted = true;
        }
        $stmt->close();
        $this->connection->close();
        return $lenguageDeleted;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function getIsoCode()
    {
        return $this->isoCode;
    }

    public function getAudio()
    {
        return $this->audio;
    }
}
