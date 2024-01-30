<?php

require_once 'AppController.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../DBManager/DBConnection.php';
require_once __DIR__ . '/../DBManager/UserDatabase.php';



class SecurityController extends AppController
{
    private UserDatabase $userDatabase;

    public function __construct() {
        parent::__construct();
        $this->userDatabase = new UserDatabase();
    }

    public function login(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if ($this->isPost()) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Both email and password are required.';
                header('Location: /login');
                exit();
            }

            $user = $this->userDatabase->getUserByEmail($email);

            if ($user && isset($user['userID']) && password_verify($password, $user['password'])) {
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['roleID'] = $user['roleID'];
                $_SESSION['login'] = $user['login'];
                header('Location: /categories');
            } else {
                $_SESSION['error'] = 'Invalid login or password.';
                header('Location: /login');
            }
            exit();
        }


        $this->render('login');
    }

    public function registration(): void
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($this->isPost()) {

            $login = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (empty($login) || empty($email) || empty($password) || empty($confirm_password)) {
                $_SESSION['error'] = 'All fields are required.';
                header('Location: /registration');
                exit();
            }

            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Passwords do not match.';
                header('Location: /registration');
                exit();
            }


            $existingUser = $this->userDatabase->getUserByEmail($email);
            if ($existingUser) {
                $_SESSION['error'] = 'User with this email already exists.';
                header('Location: /registration');
                exit();
            }

            $this->userDatabase->addUser($login, $email, $password);

            $_SESSION['success'] = 'Registration successful!';
            header('Location: /login');
            exit();
        }

        $this->render('login');
    }

    public function logout() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_start();
            session_unset();
            session_destroy();
        }
        header("Location: /login");
        exit();
    }
}