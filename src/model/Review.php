<?php

namespace model;

class Review
{
    private $reviewID;
    private $userID;
    private $contentID;
    private $reviewText;
    private $rating;
    private $reviewDate;
    private $access;

    public function __construct($reviewID, $userID, $contentID, $reviewText, $rating, $reviewDate, $access)
    {
        $this->reviewID = $reviewID;
        $this->userID = $userID;
        $this->contentID = $contentID;
        $this->reviewText = $reviewText;
        $this->rating = $rating;
        $this->reviewDate = $reviewDate;
        $this->access = $access;
    }

    public function getReviewID()
    {
        return $this->reviewID;
    }

    public function setReviewID($reviewID): void
    {
        $this->reviewID = $reviewID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID): void
    {
        $this->userID = $userID;
    }

    public function getContentID()
    {
        return $this->contentID;
    }

    public function setContentID($contentID): void
    {
        $this->contentID = $contentID;
    }

    public function getReviewText()
    {
        return $this->reviewText;
    }

    public function setReviewText($reviewText): void
    {
        $this->reviewText = $reviewText;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    public function getReviewDate()
    {
        return $this->reviewDate;
    }

    public function setReviewDate($reviewDate): void
    {
        $this->reviewDate = $reviewDate;
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function setAccess($access): void
    {
        $this->access = $access;
    }




}