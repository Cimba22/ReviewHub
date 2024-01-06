<?php

namespace repository;

class CategoryRepository extends \Repository
{
    public function addCategory(int $id, string $name): void
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO category (id, name)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $id,
            $name
        ]);
    }

    public function deleteCategory(int $id): void
    {
        $stmt = $this->database->connect()->prepare('
        DELETE FROM category
        WHERE id = ?
    ');

        $stmt->execute([$id]);
    }

    public function updateCategoryName(int $id, string $newName): void {
        $stmt = $this->database->connect()->prepare('
        UPDATE category
        SET name = ?
        WHERE id = ?
    ');

        $stmt->execute([$newName, $id]);
    }


}