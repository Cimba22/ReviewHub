<?php


use model\User;

require_once 'AppController.php';
require_once __DIR__.'/../model/User.php';

class SecurityController extends AppController
{
    public function login() {
        $user = new User('sansastark@gmail.com', 'queen', 'wolf');

        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messeges' => ['User with this email not exist.']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login');
        }

        return $this->render('dashboard');
    }

    public function registration()
    {

    }


}