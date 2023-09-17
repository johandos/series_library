<?php

namespace models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Translate {
    private $seriesId;
    private $languageId;
    private $connection;

    public function __construct($seriesId = null, $languageId = null) {
        if ($seriesId !== null) {
            $this->seriesId = $seriesId;
        }
        if ($languageId !== null) {
            $this->languageId = $languageId;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function insert($seriesId, $languageId) {
        $translateCreated = false;
        $stmt = $this->connection->prepare("INSERT INTO translate (id_serie, id_leng) VALUES (?, ?)");
        $stmt->bind_param("ii", $seriesId, $languageId);
        if ($stmt->execute()) {
            $translateCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $translateCreated;
    }

    public function delete($seriesId, $languageId) {
        $translateDeleted = false;
        $stmt = $this->connection->prepare("DELETE FROM translate WHERE id_serie = ? AND id_leng = ?");
        $stmt->bind_param("ii", $seriesId, $languageId);
        if ($stmt->execute()) {
            $translateDeleted = true;
        }
        $stmt->close();
        $this->connection->close();
        return $translateDeleted;
    }

    public function getSeriesId() {
        return $this->seriesId;
    }

    public function getLanguageId() {
        return $this->languageId;
    }
}
