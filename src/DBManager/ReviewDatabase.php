<?php

namespace DBManager;

class ReviewDatabase extends \DBManager\Database
{


    public function addReview(int $id, string $title, int $categoryID): void
    {
        //TODO: add idCategory, text of review, maybe cover of review
        $stmt = $this->database->connect()->prepare('
            INSERT INTO review(id, title, category_id)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $id,
            $title,
            $categoryID
        ]);
    }


    public function deleteReview(int $id): void
    {
        $stmt = $this->database->connect()->prepare('
        DELETE FROM review
        WHERE id = ?
    ');

        $stmt->execute([$id]);
    }



}