<!DOCTYPE html>
<html lang="en">

<?php
include('partials/head.php');

// get back form data if was any error 
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

// delete signup data session 
unset($_SESSION['add-category-data']);

?>

<body>
    <?php
    include('partials/header.php');
    ?>

    <div class="website-wrapper">
        <main class="main-content section-wrapper">
            <div class="section-content-wide">
                <div class="section-gap">
                    <div class="post-section">
                        <div class="form-container">
                            <h2>Add Category</h2>
                            <?php if (isset($_SESSION['add-category'])): ?>
                                <div class="alert__message error">
                                    <p>
                                        <?= $_SESSION['add-category'];
                                        unset($_SESSION['add-category']);
                                        ?>
                                    </p>
                                </div>
                            <?php endif ?>
                            <form action="<?= WEBSITE_URL ?>add-category-logic.php" method="POST">
                                <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
                                <textarea rows="4" name="description"
                                    placeholder="Description"><?= $description ?></textarea>
                                <button type="submit" name="submit" class="btn">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <?php
    include('partials/footer.php');
    ?>

</body>

</html>