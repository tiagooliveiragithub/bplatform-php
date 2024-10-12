<!DOCTYPE html>
<html lang="en">

<?php
include('partials/head.php');

$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

// get data from the form if any problem 
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;
unset($_SESSION['add-post-data']);
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
                            <h2>Add Post</h2>
                            <?php if (isset($_SESSION['add-post'])): ?>
                                <div class="alert-msg error">
                                    <p>
                                        <?= $_SESSION['add-post'];
                                        unset($_SESSION['add-post']);
                                        ?>
                                    </p>
                                </div>

                            <?php endif ?>
                            <form action="<?= WEBSITE_URL ?>add-post-logic.php" enctype="multipart/form-data"
                                method="POST">
                                <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
                                <select name="category">
                                    <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                                        <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                    <?php endwhile ?>
                                </select>
                                <textarea rows="10" name="body" placeholder="Body"><?= $title ?></textarea>
                                <?php if (isset($_SESSION['user_is_admin'])): ?>
                                    <div class="form-control inline">
                                        <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                                        <label for="is_featured">Featured</label>
                                    </div>
                                <?php endif ?>
                                <div class="form-control">
                                    <label for="thumbnail">Add Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail">
                                </div>
                                <button type="submit" name="submit" class="btn">Add Post</button>
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