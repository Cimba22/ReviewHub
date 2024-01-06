<?php

require_once 'Repository.php';
require_once __DIR__.'/../model/User.php';
class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['email'],
            $user['login'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['role']
        );
    }

    public function addUser(string $name, string $surname, string $email, string $password): void
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user (id, name, surname, email, password)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $name,
            $surname,
            $email,
            password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function deleteUser(int $id): void
    {
        $stmt = $this->database->connect()->prepare('
        DELETE FROM user
        WHERE id = ?
    ');

        $stmt->execute([$id]);
    }


}