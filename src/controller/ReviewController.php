<?php

use model\Review;
use session\SessionManager;

require_once 'AppController.php';

class ReviewController extends \AppController
{

    public function review(): void
    {
//        $userID = SessionManager::getCurrentUserID();
//        $reviews = (new ReviewDatabase)->getReviews($userID);
//        $this->render('dashboard', ['reviews' => $reviews]);
        $this->render('dashboard');
    }

    public function addReview() {

    }

    public function updateReview() {

    }

    public function downloadReview() {

    }

    public function deleteReview() {

    }
}