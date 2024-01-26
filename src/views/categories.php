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
    

    <?php
    include 'component/menu.php';
    ?>




    <div class="project__page">
        <div class="container">
            <div class="main__inner">

                <?php
                include 'component/mainHeader.php'
                ?>


                <div class="add__btn">
                    <a href="/add">Add new review</a>
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