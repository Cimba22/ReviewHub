<?php




require_once 'AppController.php';



class DefaultController extends AppController{


    public function index(): void
    {
        $this->render('hello-page');
    } 


    public function login(): void
    {
        $this->render('login');
    }



    
}