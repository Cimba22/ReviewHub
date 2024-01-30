<?php



require_once 'AppController.php';
require_once __DIR__ . '/../DBManager/DBConnection.php';
require_once __DIR__ . '/../DBManager/ReviewDatabase.php';
require_once __DIR__ . '/../session/SessionManager.php';

class ReviewController extends \AppController
{

    private ReviewDatabase $reviewDatabase;

    public function __construct()
    {
        parent::__construct();
        $this->reviewDatabase = new ReviewDatabase();
    }

    public function reviews(): void
    {
        $userID = SessionManager::getCurrentUserID();

        $categoryID = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 1;

        $reviews = $this->reviewDatabase->getReviewsByCategoryAndUser($categoryID, $userID);
        $this->render('reviews', ['reviews' => $reviews]);
    }

    public function reviewDetails(): void
    {
        $reviewID = isset($_GET['reviewID']) ? (int)$_GET['reviewID'] : null;

        if (!is_numeric($reviewID)) {
            echo "Invalid review ID";
            exit();
        }

        $reviewDetails = $this->reviewDatabase->getReviewDetails($reviewID);
        $this->render('reviewDetails', ['reviewDetails' => $reviewDetails]);
    }


    public function reviewsByCategory(): void
    {
        $categoryID = $_GET['category_id'] ?? null;

        if (!is_numeric($categoryID)) {
            echo "Invalid category ID";
            exit();
        }

        $userID = SessionManager::getCurrentUserID();

        $reviews = $this->reviewDatabase->getReviewsByCategoryAndUser($categoryID, $userID);
        $this->render('reviews', ['reviews' => $reviews]);
    }

    public function add(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($this->isPost()) {
            $directorOrAuthor = filter_input(INPUT_POST, 'directorOrAuthor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_FLOAT);
            $categoryid = filter_input(INPUT_POST, 'categories', FILTER_VALIDATE_INT);
            $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $userID = SessionManager::getCurrentUserID();

            if ($userID === null) {
                $_SESSION['error'] = 'User not logged in.';
                header('Location: /login');
                exit();
            }

            if (!is_numeric($rating) || $rating < -10 || $rating > 10) {
                $_SESSION['error'] = 'Invalid rating value.';
                header('Location: /add');
                exit();
            }

            $success = $this->reviewDatabase->addReview($userID, $directorOrAuthor, $title, $rating, $categoryid, $reviewText);

            if ($success) {
                $_SESSION['success'] = 'Review added successfully!';
                header('Location: /categories');
                exit();
            } else {
                $_SESSION['error'] = 'Failed to add review. Please try again later.';
                header('Location: /add');
                exit();
            }
        }

        $this->render('add');
    }


    public function updateReview() {

    }

    public function downloadReview() {

    }

    public function delete(): void
    {
        if ($this->isPost()) {
            $userID = SessionManager::getCurrentUserID();
            $categoryID = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
            $reviewID = filter_input(INPUT_POST, 'reviewID', FILTER_VALIDATE_INT);

            if ($userID !== null && $categoryID !== false && $reviewID !== false) {
                $success = $this->reviewDatabase->deleteReviewById($reviewID);

                if ($success) {
                    $_SESSION['success'] = 'Review deleted successfully!';
                } else {
                    $_SESSION['error'] = 'Failed to delete review. Please try again later.';
                }
            } else {
                $_SESSION['error'] = 'Invalid parameters for review deletion.';
            }

            header('Location: /categories');
            exit();
        }
    }

}