<?php


require_once __DIR__ . '/Database.php';

require_once __DIR__ . '/../model/User.php';


class UserDatabase extends Database
{
    public function getUserByEmail($email) {
        try {
            $stmt = $this->database->getConnection()->prepare("SELECT * FROM public.users WHERE email = :email");
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user === false) {
                    return null;
                }

                return $user;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }


    public function addUser(string $login, string $email, string $password): void
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if (!$hashedPassword) {
                throw new Exception("Error hashing the password.");
            }

            $stmt = $this->database->getConnection()->prepare('
            INSERT INTO users (login, email, password)
            VALUES (:login, :email, :password)
        ');

            if ($stmt === false) {
                throw new Exception("Error preparing the SQL statement.");
            }

            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                throw new Exception("No rows were inserted. Possible error.");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserInformation($userID) {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM userInformation WHERE userID = :userID");
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUserInformation($userID, $name, $surname, $registrationDate, $avatar): void
    {
        $stmt = $this->database->getConnection()->prepare("INSERT INTO UserInformation (userID, name, surname, registrationDate, avatar) 
                                   VALUES (:userID, :firstName, :lastName, :registrationDate, :avatar)");
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':firstName', $name);
        $stmt->bindParam(':lastName', $surname);
        $stmt->bindParam(':registrationDate', $registrationDate);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->execute();
    }



    public function deleteUser(int $id): void
    {
        $stmt = $this->database->getConnection()->prepare('
        DELETE FROM user
        WHERE userID = ?
    ');
        $stmt->execute([$id]);
    }


}