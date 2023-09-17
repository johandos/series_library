<?php

namespace models;

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
    private $connection;

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
        $query = $this->connection->query("SELECT * FROM series");
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

    public function insert(
        $title,
        $subtitle,
        $img,
        $trailer,
        $rating,
        $synopsis,
        $releaseDate,
        $directorId,
        $genreId,
        $restrictionId
    ) {
        $seriesCreated = false;
        $query = "INSERT INTO series (
            title, subtitle, img, trailer, rating, synopsis, release_date, id_dir, id_gen, id_restrict
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(
            "ssssissiii",
            $title,
            $subtitle,
            $img,
            $trailer,
            $rating,
            $synopsis,
            $releaseDate,
            $directorId,
            $genreId,
            $restrictionId
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
        $title,
        $subtitle,
        $img,
        $trailer,
        $rating,
        $synopsis,
        $releaseDate,
        $directorId,
        $genreId,
        $restrictionId
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
            $title,
            $subtitle,
            $img,
            $trailer,
            $rating,
            $synopsis,
            $releaseDate,
            $directorId,
            $genreId,
            $restrictionId,
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
        $seriesDeleted = false;
        $stmt = $this->connection->prepare("DELETE FROM series WHERE id_serie = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $seriesDeleted = true;
        }
        $stmt->close();
        $this->connection->close();
        return $seriesDeleted;
    }

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

    public function getGenreId()
    {
        return $this->genreId;
    }

    public function getRestrictionId()
    {
        return $this->restrictionId;
    }
}
