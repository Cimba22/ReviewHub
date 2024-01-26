<?php

require_once __DIR__ . '/Database.php';
class ReviewDatabase extends Database
{

    public function getReviews($userID): false|array
    {
        try {
            $conn = $this->database->getConnection();

            $query = 'SELECT r."reviewID", r."userID", r."contentID", r."reviewText", r."rating", r."reviewDate", r."access", r."categoryid", r."lastModified",
                                 c."title", c."directorOrAuthor", c."genre", c."releaseYear", c."rating" as "contentRating", c."dateAdded" as "contentDateAdded",
                                 cat."categoryname"
                          FROM "reviews" r
                          JOIN "content" c ON r."contentID" = c."contentID"
                          JOIN "category" cat ON r."categoryid" = cat."categoryid"
                          WHERE r."userID" = :userID
                          ORDER BY r."reviewDate" DESC';

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Ошибка подключения к базе данных: " . $e->getMessage();
            return [];
        }
    }

    public function getReviewByCategoryId($categoryId)
    {
        try {
            $connection = $this->database->getConnection();

            $query = "
                SELECT 
                    r.*, 
                    u.login AS username, 
                    c.title AS content_title
                FROM 
                    reviews r
                    JOIN users u ON r.\"userID\" = u.\"userID\"
                    JOIN content c ON r.\"contentID\" = c.\"contentID\"
                WHERE 
                    r.categoryid = :categoryId
            ";

            $statement = $connection->prepare($query);
            $statement->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Ошибка при получении отзывов: " . $e->getMessage());
        }
    }

    public function getReviewsByCategoryAndUser($categoryID, $userID): false|array
    {
        try {
            $conn = $this->database->getConnection();

            $query = '
            SELECT r."reviewID", r."userID", r."contentID", r."reviewText", r."rating", r."reviewDate", r."access", r."categoryid", r."lastModified",
                   c."title", c."directorOrAuthor", c."genre", c."releaseYear", c."rating" as "contentRating", c."dateAdded" as "contentDateAdded",
                   cat."categoryname"
            FROM "reviews" r
            JOIN "content" c ON r."contentID" = c."contentID"
            JOIN "category" cat ON r."categoryid" = cat."categoryid"
            WHERE r."userID" = :userID AND r."categoryid" = :categoryID
            ORDER BY r."reviewDate" DESC';

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Ошибка подключения к базе данных: " . $e->getMessage();
            return [];
        }
    }


    public function getReviewTitleByCategoryId($categoryId)
    {
        try {
            $connection = $this->database->getConnection();

            $query = "
                SELECT 
                    c.title AS review_title
                FROM 
                    reviews r
                    JOIN content c ON r.\"contentID\" = c.\"contentID\"
                WHERE 
                    r.categoryid = :categoryId
            ";

            $statement = $connection->prepare($query);
            $statement->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            die("Ошибка при получении заголовков отзывов: " . $e->getMessage());
        }
    }


    public function getReviewDetails($reviewID)
    {
        try {
            $connection = $this->database->getConnection();

            $query = "
            SELECT 
                r.\"reviewID\", 
                r.\"userID\", 
                r.\"contentID\", 
                r.\"reviewText\", 
                r.\"rating\", 
                r.\"reviewDate\", 
                r.\"access\", 
                r.\"categoryid\", 
                r.\"lastModified\",
                c.\"title\" AS content_title,
                c.\"directorOrAuthor\",
                c.\"genre\",
                c.\"releaseYear\",
                c.\"rating\" AS content_rating,
                c.\"dateAdded\",
                c.\"categoryid\" AS content_categoryid
            FROM 
                reviews r
                JOIN content c ON r.\"contentID\" = c.\"contentID\"
            WHERE 
                r.\"reviewID\" = :reviewID
        ";

            $statement = $connection->prepare($query);
            $statement->bindParam(":reviewID", $reviewID, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Ошибка при получении деталей отзыва: " . $e->getMessage());
        }
    }




    public function addReview($userID, $directorOrAuthor, $title, $rating, $categoryid, $reviewText): bool
    {
        try {
            // Проверки на ошибки валидации
            if (!is_numeric($rating) || $rating < -10 || $rating > 10) {
                return false;
            }

            $conn = $this->database->getConnection();

            // Проверяем, существует ли категория с указанным ID
            $stmtCheckCategory = $conn->prepare('SELECT categoryid FROM category WHERE categoryid = ?');
            $stmtCheckCategory->bindParam(1, $categoryid);
            $stmtCheckCategory->execute();

            if ($stmtCheckCategory->rowCount() === 0) {
                $_SESSION['error'] = 'Invalid category.';
                header('Location: /add');
                exit();
            }

            // Вставляем данные в таблицу content и получаем ID вставленной записи
            $stmtContent = $conn->prepare('INSERT INTO content (title, "directorOrAuthor", rating, categoryid) VALUES (?, ?, ?, ?) RETURNING "contentID"');
            $stmtContent->bindParam(1, $title);
            $stmtContent->bindParam(2, $directorOrAuthor);
            $stmtContent->bindParam(3, $rating);
            $stmtContent->bindParam(4, $categoryid);

            if (!$stmtContent->execute()) {
                $_SESSION['error'] = 'Failed to add content.';
                header('Location: /add');
                exit();
            }

            $contentID = $stmtContent->fetchColumn();  // Получаем ID вставленной записи из RETURNING

            // Вставляем данные в таблицу reviews
            $stmtReviews = $conn->prepare('INSERT INTO reviews ("userID", "contentID", "reviewText", "reviewDate", "categoryid") VALUES (?, ?, ?, CURRENT_DATE, ?)');
            $stmtReviews->bindParam(1, $userID);
            $stmtReviews->bindParam(2, $contentID);
            $stmtReviews->bindParam(3, $reviewText);
            $stmtReviews->bindParam(4, $categoryid);

            if (!$stmtReviews->execute()) {
                $_SESSION['error'] = 'Failed to add review.';
                header('Location: /add');
                exit();
            }

            return true;
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Error: ' . $e->getMessage();
            header('Location: /add');
            exit();
        }
    }








    public function deleteReviewById($reviewId): bool
    {
        try {
            $connection = $this->database->getConnection();

            // Убедимся, что у нас есть соединение
            if (!$connection) {
                $_SESSION['error'] = 'Database connection error.';
                header('Location: /categories');
                exit();
            }

            $queryDeleteReview = "DELETE FROM reviews WHERE \"reviewID\" = :reviewId";
            $statementDeleteReview = $connection->prepare($queryDeleteReview);
            $statementDeleteReview->bindParam(":reviewId", $reviewId, PDO::PARAM_INT);

            if (!$statementDeleteReview->execute()) {
                $_SESSION['error'] = 'Failed to delete review from reviews table.';
                header('Location: /categories');
                exit();
            }

            $queryDeleteContent = "
            DELETE FROM content
            WHERE \"contentID\" IN (
                SELECT r.\"contentID\"
                FROM reviews r
                WHERE r.\"reviewID\" = :reviewId
            )
        ";
            $statementDeleteContent = $connection->prepare($queryDeleteContent);
            $statementDeleteContent->bindParam(":reviewId", $reviewId, PDO::PARAM_INT);

            if (!$statementDeleteContent->execute()) {
                $_SESSION['error'] = 'Failed to delete review from content table.';
                header('Location: /categories');
                exit();
            }

            // Получаем количество удаленных строк из обоих таблиц
            $rowCount = $statementDeleteReview->rowCount() + $statementDeleteContent->rowCount();

            return $rowCount > 0;
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Error deleting review: ' . $e->getMessage();
            header('Location: /categories');
            exit();
        }
    }




}