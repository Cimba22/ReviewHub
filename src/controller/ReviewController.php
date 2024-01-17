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
        $userLogin = SessionManager::getCurrentUserLogin();

        $categoryID = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 1;

        $reviews = $this->reviewDatabase->getReviewsByCategoryAndUser($categoryID, $userID);
        $this->render('reviews', ['reviews' => $reviews]);
    }

    public function reviewsByCategory(): void
    {
        // Получаем id категории из строки запроса
        $categoryID = isset($_GET['category_id']) ? $_GET['category_id'] : null;

        // Проверяем, чтобы избежать SQL-инъекций (лучше использовать подготовленные запросы)
        if (!is_numeric($categoryID)) {
            echo "Invalid category ID";
            exit();
        }

        // Получаем id пользователя из сессии
        $userID = SessionManager::getCurrentUserID();

        // Получаем отзывы по категории и id пользователя
        $reviews = $this->reviewDatabase->getReviewsByCategoryAndUser($categoryID, $userID);

        // Рендерим страницу с отзывами по категории
        $this->render('reviews', ['reviews' => $reviews]);
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