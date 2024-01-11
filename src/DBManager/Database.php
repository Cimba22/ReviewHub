<?php

require_once "DBConnection.php";

class Database
{
    protected ?DBConnection $database;

    public function __construct()
    {
        $this->database = DBConnection::getInstance();
    }
}