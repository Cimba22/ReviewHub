
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
            <div class="main__inner">

                <div class="main__header">
                    <div class="reviewName">
                        <?php if (!empty($reviewDetails) && isset($reviewDetails['content_title'])): ?>
                            <h1><?= ($reviewDetails['content_title']) ?></h1>
                        <?php else: ?>
                            <h1>(No title)</h1>
                        <?php endif; ?>
                    </div>
                </div>

                <?= $reviewDetails['reviewText']?>
            </div>

            <?php
            $reviewIdFromUrl = $_GET['reviewID'] ?? null;
            ?>

            <div class="delete__btn">
                <form action="/delete" method="post">
                    <input type="hidden" name="reviewID" value="<?php echo htmlspecialchars($reviewIdFromUrl); ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete the review?')">Delete Review</button>
                </form>
            </div>
        </div>
    </div>


</body>
</html>