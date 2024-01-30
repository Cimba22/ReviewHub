
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

    <title>Books</title>
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

                <section class="theme__boxes">
                    <?php foreach ($reviews as $review): ?>
                        <div class="theme__box">
                            <a class="category__link" href="/reviewDetails?reviewID=<?= $review['reviewID'] ?>">
                                <h3 class="box__name"><?= $review['title'] ?></h3>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </section>
            </div>
        </div>
    </div>


</body>
</html>