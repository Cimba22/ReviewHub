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


    public function addReview(int $id, string $title, int $categoryID): void
    {

    }


    public function deleteReviewById($reviewId)
    {
        try {
            $connection = $this->database->getConnection();

            $query = "
                DELETE FROM content
                WHERE \"contentID\" IN (
                    SELECT r.\"contentID\"
                    FROM reviews r
                    WHERE r.\"reviewID\" = :reviewId
                );

                DELETE FROM reviews
                WHERE \"reviewID\" = :reviewId
            ";

            $statement = $connection->prepare($query);
            $statement->bindParam(":reviewId", $reviewId, PDO::PARAM_INT);
            $statement->execute();

            // Проверяем, были ли удалены какие-либо строки
            $rowCount = $statement->rowCount();

            return $rowCount > 0;
        } catch (PDOException $e) {
            die("Ошибка при удалении отзыва: " . $e->getMessage());
        }
    }



}