<?php

require_once 'AppController.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../DBManager/DBConnection.php';
require_once __DIR__ . '/../DBManager/UserDB.php';
require_once __DIR__.'/../repository/UserRepository.php';



class SecurityController extends AppController
{

//    private UserDB $userDB;
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/projects");
    }

    public function registration($login, $email, $password)
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }



//        $login = $_POST['login'];
//        $email = $_POST['email'];
//        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirm_password'];

        $existingUser = $this->userDB->getUser($email);

        if ($existingUser) {
            return "User already exists";
        }else {
            if ($password !== $confirmedPassword) {
                return $this->render('register', ['messages' => ['Please provide proper password']]);
            }


            $result = $this->userDB->addUser($login, $email, $password);
            if ($result) {
                return "Registration successful!";
            } else {
                return "Registration failed";
            }
        }
    }

    public function logout() {

    }


}