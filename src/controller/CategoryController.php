<?php

require_once 'AppController.php';
require_once __DIR__ . '/../DBManager/DBConnection.php';
require_once __DIR__ . '/../DBManager/CategoryDatabase.php';

class CategoryController extends \AppController
{

    private CategoryDatabase $categoryDatabase;

    public function __construct()
    {
        parent::__construct();
        $this->categoryDatabase = new CategoryDatabase();
    }

    public function categories(): void
    {
        $categories = $this->categoryDatabase->getCategories();
        $this->render('categories', ['categories' => $categories]);
    }

}