<?php

namespace model;

class Content
{
    private $contentID;
    private $title;
    private $directorOrAuthor;
    private $genre;
    private $releaseYear;
    private $rating;
    private $dateAdded;

    public function __construct($contentID, $title, $directorOrAuthor, $genre, $releaseYear, $rating, $dateAdded)
    {
        $this->contentID = $contentID;
        $this->title = $title;
        $this->directorOrAuthor = $directorOrAuthor;
        $this->genre = $genre;
        $this->releaseYear = $releaseYear;
        $this->rating = $rating;
        $this->dateAdded = $dateAdded;
    }

    public function getContentID()
    {
        return $this->contentID;
    }

    public function setContentID($contentID): void
    {
        $this->contentID = $contentID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDirectorOrAuthor()
    {
        return $this->directorOrAuthor;
    }

    public function setDirectorOrAuthor($directorOrAuthor): void
    {
        $this->directorOrAuthor = $directorOrAuthor;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre): void
    {
        $this->genre = $genre;
    }

    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    public function setReleaseYear($releaseYear): void
    {
        $this->releaseYear = $releaseYear;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function setDateAdded($dateAdded): void
    {
        $this->dateAdded = $dateAdded;
    }



}