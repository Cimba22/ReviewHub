<?php


require_once __DIR__ . '/Database.php';

require_once __DIR__ . '/../model/User.php';


class UserDatabase extends Database
{
    public function getUserByEmail($email) {
        try {
            $stmt = $this->database->getConnection()->prepare("SELECT * FROM Users WHERE Email = :email");
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user === false) {
                    // Пользователь с такой электронной почтой не найден
                    return null;
                }

                return $user;
            } else {
                // Ошибка выполнения запроса
                return null;
            }
        } catch (PDOException $e) {
            // Обработка ошибок PDO
            return null;
        }
    }


    public function addUser(string $name, string $surname, string $email, string $password): void
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if (!$hashedPassword) {
                // Ошибка хеширования пароля
                throw new Exception("Error hashing the password.");
            }

            $stmt = $this->database->getConnection()->prepare('
            INSERT INTO user (name, surname, email, password)
            VALUES (:name, :surname, :email, :password)
        ');

            if ($stmt === false) {
                // Ошибка подготовки запроса
                throw new Exception("Error preparing the SQL statement.");
            }

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                // Ни одна строка не была добавлена, возможно, произошла ошибка
                throw new Exception("No rows were inserted. Possible error.");
            }
        } catch (Exception $e) {
            // Обработка ошибок
            // Например, можно логировать ошибку или выбрасывать ее дальше
            echo "Error: " . $e->getMessage();
        }
    }

    public function getUserInformation($userID) {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM UserInformation WHERE UserID = :userID");
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUserInformation($userID, $firstName, $lastName, $registrationDate, $avatar): void
    {
        $stmt = $this->database->getConnection()->prepare("INSERT INTO UserInformation (UserID, FirstName, LastName, RegistrationDate, Avatar) 
                                   VALUES (:userID, :firstName, :lastName, :registrationDate, :avatar)");
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':registrationDate', $registrationDate);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->execute();
    }



    public function deleteUser(int $id): void
    {
        $stmt = $this->database->getConnection()->prepare('
        DELETE FROM user
        WHERE id = ?
    ');

        $stmt->execute([$id]);
    }


}