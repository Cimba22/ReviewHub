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
            // Обработка логинации
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Both email and password are required.';
                header('Location: /login'); // перенаправляем обратно на страницу входа
                exit();
            }

            // Проверка наличия пользователя в базе данных
            $user = $this->userDatabase->getUserByEmail($email);

            if ($user && isset($user['userID']) && password_verify($password, $user['password'])) {
                // Пользователь аутентифицирован, выполните необходимые действия
                $_SESSION['userId'] = $user['userID']; // сохраняем ID пользователя в сессии
                //Todo Сделать нормальные переход на страницу через DefaultController, а не через функцию в ReviewController
                header('Location: /dashboard'); // перенаправляем на страницу после успешного входа
            } else {
                // Неправильный логин или пароль
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
            // Обработка регистрации
            $login = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (empty($login) || empty($email) || empty($password) || empty($confirm_password)) {
                $_SESSION['error'] = 'All fields are required.';
                header('Location: /registration'); // перенаправляем обратно на страницу регистрации
                exit();
            }

            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Passwords do not match.';
                header('Location: /registration');
                exit();
            }

            // Дополнительные проверки, например, проверка уникальности email
            $existingUser = $this->userDatabase->getUserByEmail($email);
            if ($existingUser) {
                $_SESSION['error'] = 'User with this email already exists.';
                header('Location: /registration');
                exit();
            }

            $this->userDatabase->addUser($login, $email, $password);

            $_SESSION['success'] = 'Registration successful!';
            header('Location: /login'); // перенаправляем на страницу входа после успешной регистрации
            exit();
        }

        $this->render('login');
    }




    //TODO add session for it
//    public function logout() {
//        // Разрушаем сессию и перенаправляем пользователя на страницу логина
//        session_start();
//        session_unset();
//        session_destroy();
//        header("Location: /login"); // Укажите URL вашей страницы логина
//        exit();
//    }


}