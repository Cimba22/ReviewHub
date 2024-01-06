<?php
require_once 'DBConnection.php';
require_once __DIR__.'/../model/User.php';

class UserDB extends DBConnection
{

//    private $db;
//
//    public function __construct() {
//        $this->db = DBConnection::getInstance()->getConnection();
//    }
//    public function getUser(string $email): ?User
//    {
//        $stmt = $this->db->prepare("SELECT * FROM \"user\" WHERE email = :email");
//        $stmt->execute(array(':username' => $email));
//        return $stmt->fetch(PDO::FETCH_ASSOC);
//
//    }
//
//    public function addUser($login, $email, $password): int
//    {
//        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
//        $stmt = $this->db->prepare("INSERT INTO \"user\" (login, email, password) VALUES (:login, email, :password)");
//        $stmt->execute(array(':login' =>$login, ':email' => $email, ':password' => $hashedPassword));
//        return $stmt->rowCount();
//
//    }
}