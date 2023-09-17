<?php

namespace Models;

require_once __DIR__ . '/../Helper/Connection.php';

use Helper\Connection;

class Series {
    private $id;
    private $title;
    private $subtitle;
    private $img;
    private $trailer;
    private $rating;
    private $synopsis;
    private $releaseDate;
    private $directorId;
    private $genreId;
    private $restrictionId;
    private $status;
    private $connection;


    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getTrailer()
    {
        return $this->trailer;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function getDirectorId()
    {
        return $this->directorId;
    }

    public function getGenderId()
    {
        return $this->genreId;
    }

    public function getRestrictionId()
    {
        return $this->restrictionId;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function __construct(
        $id = null,
        $title = null,
        $subtitle = null,
        $img = null,
        $trailer = null,
        $rating = null,
        $synopsis = null,
        $releaseDate = null,
        $directorId = null,
        $genreId = null,
        $restrictionId = null
    ) {
        if ($id !== null) {
            $this->id = $id;
        }
        if ($title !== null) {
            $this->title = $title;
        }
        if ($subtitle !== null) {
            $this->subtitle = $subtitle;
        }
        if ($img !== null) {
            $this->img = $img;
        }
        if ($trailer !== null) {
            $this->trailer = $trailer;
        }
        if ($rating !== null) {
            $this->rating = $rating;
        }
        if ($synopsis !== null) {
            $this->synopsis = $synopsis;
        }
        if ($releaseDate !== null) {
            $this->releaseDate = $releaseDate;
        }
        if ($directorId !== null) {
            $this->directorId = $directorId;
        }
        if ($genreId !== null) {
            $this->genreId = $genreId;
        }
        if ($restrictionId !== null) {
            $this->restrictionId = $restrictionId;
        }

        $this->connection = new Connection();
        $this->connection = $this->connection->conectar();
    }

    public function getAll()
    {
        $query = $this->connection->query("SELECT * FROM series WHERE status = true");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Series(
                $item['id_serie'],
                $item['title'],
                $item['subtitle'],
                $item['img'],
                $item['trailer'],
                $item['rating'],
                $item['synopsis'],
                $item['release_date'],
                $item['id_dir'],
                $item['id_gen'],
                $item['id_restrict']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData;
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT * FROM series WHERE id_serie = $id");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Series(
                $item['id_serie'],
                $item['title'],
                $item['subtitle'],
                $item['img'],
                $item['trailer'],
                $item['rating'],
                $item['synopsis'],
                $item['release_date'],
                $item['id_dir'],
                $item['id_gen'],
                $item['id_restrict']
            );
            $listData[] = $itemObject;
        }
        $this->connection->close();
        return $listData[0] ?? null;
    }

    public function insert($data) {
        $seriesCreated = false;
        $query = "INSERT INTO series (
            title, subtitle, img, trailer, rating, synopsis, release_date, id_dir, id_gen, id_restrict
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            "ssssissiii",
            $data['title'],
            $data['subtitle'],
            $data['img'],
            $data['trailer'],
            $data['rating'],
            $data['synopsis'],
            $data['releaseDate'],
            $data['directorId'],
            $data['genreId'],
            $data['restrictionId'],
        );
        if ($stmt->execute()) {
            $seriesCreated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $seriesCreated;
    }

    public function update(
        $id,
        $data
    ) {
        $seriesUpdated = false;
        $query = "UPDATE series SET 
            title = ?,
            subtitle = ?,
            img = ?,
            trailer = ?,
            rating = ?,
            synopsis = ?,
            release_date = ?,
            id_dir = ?,
            id_gen = ?,
            id_restrict = ?
            WHERE id_serie = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            "ssssissiiii",
            $data['title'],
            $data['subtitle'],
            $data['img'],
            $data['trailer'],
            $data['rating'],
            $data['synopsis'],
            $data['releaseDate'],
            $data['directorId'],
            $data['genreId'],
            $data['restrictionId'],
            $id
        );
        if ($stmt->execute()) {
            $seriesUpdated = true;
        }
        $stmt->close();
        $this->connection->close();
        return $seriesUpdated;
    }

    public function delete($id)
    {
        $directorDelete = false;
        $query = "UPDATE series SET status = false WHERE id_serie = $id";
        $stmt = $this->connection->prepare($query);
        if ($stmt->execute()) {
            $directorDelete = true;
        }
        $stmt->close();
        $this->connection->close();
        return $directorDelete;
    }
}
