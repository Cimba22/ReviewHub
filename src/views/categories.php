<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'/>
    <script src="public/js/greeting.js"></script>
    <script src="public/js/iconMenu.js"></script>
    <script src="public/js/confirmLogout.js"></script>

    <title>Categories</title>
</head>
<body>
    

    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a class="header__logo" href="#"> <img src="public/img/logo_dashboard.svg"></a>
                
                <div class="header__user">

                    <nav>
                        <img class="avatar__circle" src="public/img/userAvatar.svg"
                             alt size="48" height="48" width="48" >

                        <div class="sidebar">

                            <img class="avatar__circle" src="public/img/userAvatar.svg"
                                 alt size="48" height="48" width="48" >

                            <div class="sidebar_content">
                                <ul class="lists">
                                    <li class="list">
                                        <a href="#" class="nav-link">
                                            <i class='bx bx-user icon'></i>
                                            <span class="link">Your profile</span>
                                        </a>
                                    </li>

                                    <li class="list">
                                        <a href="#" class="nav-link">
                                            <i class='bx bxs-book-content icon' ></i>
                                            <span class="link">Your repositories</span>
                                        </a>
                                    </li>

                                    <li class="list">
                                        <a href="#" class="nav-link">
                                            <i class='bx bx-support icon' ></i>
                                            <span class="link">ReviewHub Support</span>
                                        </a>
                                    </li>

                                    <li class="list">
                                        <a href="#" class="nav-link">
                                            <i class='bx bx-book-open icon'></i>
                                            <span class="link">ReviewHub Docs</span>
                                        </a>
                                    </li>

                                    <li class="list">
                                        <a href="#" class="nav-link">
                                            <i class='bx bx-cog icon' ></i>
                                            <span class="link">Settings</span>
                                        </a>
                                    </li>

                                    <li class="list">
                                        <a href="/logout" class="nav-link" onclick="confirmLogout()">
                                            <span class="link">Logout</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </nav>

                    <section class="overlay"></section>
                </div>

            </div>
        </div>
    </header>




    <div class="project__page">
        <div class="container">
            <div class="main__inner">

                <div class="main__header">
                    <div class="day__hello">
                            <h2 class="msg__hello" id="greetingMessage">Good morning</h2>
                    </div>
                        
                    <div class="day__quote">
                        <h4 class="msg_quote">Did I ever tell you 
                            what the definition of insanity is?</h4>
                    </div>
                </div>

                <section class="theme__boxes">

                    <?php foreach ($categories as $category): ?>
                        <div id="<?= $category->getCategoryid(); ?>">
                            <div class="theme__box" id="box1">
                                <a class="category__link" href="/reviews?category_id=<?= $category->getCategoryid(); ?>">
                                    <img src="public/img/boxFoto.svg" alt="book">
                                    <span><h3 class="box__name"><?= $category->getCategoryname(); ?></h3></span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </section>




            </div>
        </div>
    </div>


</body>
</html>