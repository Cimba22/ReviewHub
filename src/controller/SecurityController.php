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
        if ($this->isPost()) {
            // Обработка логинации
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (empty($login) || empty($password)) {
                echo 'Both login and password are required.';
                return;
            }

            // Проверка наличия пользователя в базе данных
            $user = $this->userDatabase->getUserByEmail($login);

            if ($user && password_verify($password, $user['password'])) {
                // Пользователь аутентифицирован, выполните необходимые действия
                echo 'Logged in successfully!';
            } else {
                // Неправильный логин или пароль
                echo 'Invalid login or password.';
            }
        }

        $this->render('login');
    }

    public function registration(): void
    {
        //TODO поменять вводимые данные
        if ($this->isPost()) {
            // Обработка регистрации
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($confirm_password)) {
                echo 'All fields are required.';
                return;
            }

            if ($password !== $confirm_password) {
                echo 'Passwords do not match.';
                return;
            }

            // Дополнительные проверки, например, проверка уникальности email
            $existingUser = $this->userDatabase->getUserByEmail($email);
            if ($existingUser) {
                echo 'User with this email already exists.';
                return;
            }

            // Пример использования UserDatabase для добавления нового пользователя
//            $this->userDatabase->addUser($name, $surname, $email, $password);
//
//            // Вывод успешного сообщения или редирект на страницу логина
//            echo 'Registration successful!';
        }

        $this->render('registration');
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