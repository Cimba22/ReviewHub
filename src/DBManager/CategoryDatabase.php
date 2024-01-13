<?php


use model\Category;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../model/Category.php';

class CategoryDatabase extends Database
{

    public function getCategoryById($categoryId)
    {
        try {
            $connection = $this->database->getConnection();

            $query = "
                SELECT * FROM category
                WHERE 
                    categoryid = :categoryId
            ";

            $statement = $connection->prepare($query);
            $statement->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Ошибка при получении информации о категории: " . $e->getMessage());
        }
    }

    public function getCategories()
    {
        try {
            $connection = $this->database->getConnection();

            $query = "SELECT * FROM category";

            $statement = $connection->prepare($query);
            $statement->execute();

            $categories = [];

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $category = new Category($row['categoryid'], $row['categoryname']);
                $categories[] = $category;
            }

            return $categories;
        } catch (PDOException $e) {
            die("Ошибка при получении списка категорий: " . $e->getMessage());
        }
    }



    public function addCategory($categoryName)
    {
        try {
            $connection = $this->database->getConnection();

            $query = "
                INSERT INTO category (categoryname)
                VALUES (:categoryName)
                RETURNING categoryid;
            ";

            $statement = $connection->prepare($query);
            $statement->bindParam(":categoryName", $categoryName, PDO::PARAM_STR);
            $statement->execute();

            // Получаем идентификатор новой категории
            return $statement->fetchColumn();
        } catch (PDOException $e) {
            die("Ошибка при добавлении категории: " . $e->getMessage());
        }
    }

    public function deleteCategoryById($categoryId)
    {
        // запрос для удаления всех отзывов и самой категории по указанному categoryid.
        try {
            $connection = $this->database->getConnection();

            $query = "
                DELETE FROM reviews
                WHERE categoryid = :categoryId;

                DELETE FROM category
                WHERE categoryid = :categoryId;
            ";

            $statement = $connection->prepare($query);
            $statement->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $statement->execute();

            // Проверяем, были ли удалены какие-либо строки
            $rowCount = $statement->rowCount();

            return $rowCount > 0;
        } catch (PDOException $e) {
            die("Ошибка при удалении категории: " . $e->getMessage());
        }
    }

    public function updateCategoryNameById($categoryId, $newCategoryName)
    {
        try {
            $connection = $this->database->getConnection();

            $query = "
                UPDATE category
                SET categoryname = :newCategoryName
                WHERE categoryid = :categoryId;
            ";

            $statement = $connection->prepare($query);
            $statement->bindParam(":newCategoryName", $newCategoryName, PDO::PARAM_STR);
            $statement->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
            $statement->execute();

            // Проверяем, были ли обновлены какие-либо строки
            $rowCount = $statement->rowCount();

            return $rowCount > 0;
        } catch (PDOException $e) {
            die("Ошибка при обновлении имени категории: " . $e->getMessage());
        }
    }


}