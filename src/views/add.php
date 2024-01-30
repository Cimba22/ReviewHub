
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/dashboard.css">
    <link rel="stylesheet" href="public/css/addForm.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'/>

    <script src="public/js/greeting.js"></script>
    <script src="public/js/iconMenu.js"></script>
    <script src="public/js/markdownReader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/markdown.js/0.5.0/markdown.min.js"></script>
    <title>Books</title>

</head>
<body>



<?php
include 'component/menu.php';
?>


    <div class="project__page">
        <div class="container">
            <div class="add__container">

                <form id="addForm" action="/add" method="post">

                    <div class="informationArea">

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
                            <label for="directorOrAuthor">Author Name</label><br>
                            <input type="text" id="directorOrAuthor" name="directorOrAuthor"><br>
                        </div>

                        <div class="inputBox">
                            <label for="title">Title</label><br>
                            <input type="text" id="title" name="title">
                        </div>

                        <div class="inputBox">
                            <label for="rating">Rating</label><br>
                            <input type="number" max="10" min="-10" id="rating" name="rating">
                        </div>


                        <div class="inputBox">
                            <label for="categories">Category</label><br>
                            <select name = "categories" id="categories" >
                                <option value="1">Books</option>
                                <option value="2">Films</option>
                                <option value="3">Serials</option>
                                <option value="4">Games</option>
                                <option value="5">Podcasts</option>
                            </select>
                            <br><br>
                        </div>
                        <input class="SaveReviewText" type="submit" value="Add">
                    </div>


                    <div class="reviewText">
                        <label for="reviewText">Write your review here: </label>
                        <textarea id="reviewText" name="reviewText" rows="10" cols="100">   </textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>
</html>