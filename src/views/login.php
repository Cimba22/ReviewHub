<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;900&display=swap" rel="stylesheet">
    <title>Login</title>
    <script src="public/js/validation.js"></script>
</head>

<body>
    
    <div class="container">
        
        <div class="logo"> <img src="public/img/ParusLogo.svg"></div>
        <div class="page__heading">Sign In</div>

        <div class="login__container">
    
            <span></span>
            <span></span>
            <span></span>
            
            <form id="signinForm" action="/login" method="post">

                <div class="messages">
                    <?php
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']); // очищаем ошибку после вывода
                    }
                    ?>
                </div>

                <div class="inputBox">
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" required ><br>
                </div>

                <div class="inputBox">
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" required><br>
                </div>

                <div class="inputBox">
                    <a href="#">Forgot Your Password?</a><br>
                </div>

                <div class="inputBox">
                    <input class="btn btn-1" type="submit" value="Sign In">
                </div>

                <div class="singup">
                    <a class="signup__heading">New to ReviewHub?</a>
                    <a id="signup__link" href="#">Create an account</a>
                </div>
        
            </form>


            
            
            <form id="signupForm" action="/registration" method="post">

                <div class="messages">
                    <?php
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']); // очищаем ошибку после вывода
                    }
                    ?>
                </div>

                <div class="inputBox">
                    <label for="username">Username</label><br>
                    <input type="text" id="username" name="username" required><br>
                </div>

                <div class="inputBox">
                    <label for="email">Email Address</label><br>
                    <input type="email" id="email" name="email" required><br>
                </div>

                <div class="inputBox">
                    <label for="password">Create Password</label><br>
                    <input type="password" id="password" name="password" required><br>
                </div>

                <div class="inputBox">
                    <label for="confirm_password">Repeat Password</label><br>
                    <input type="password" id="confirm_password" name="confirm_password" required><br>
                </div>

                <div class="inputBox">
                    <input class="btn btn-1" type="submit" value="Create Account">
                </div>

                <div class="singup">
                    <a class="signin__heading">Have an account?</a>
                    <a id="signin__link" href="#">Sign In</a>
                </div>
        
            </form>


        </div>
    </div>

    <script>
        let signup__link = document.querySelector('#signup__link');
        let signin__link = document.querySelector('#signin__link');
        let body = document.querySelector('body');
        signup__link.onclick = function(){
            body.classList.add('signup__link');
        }
        signin__link.onclick = function(){
            body.classList.remove('signup__link');
        }
    </script>

</body>
</html>