<!DOCTYPE html>
<html lang="en">

<?php
include('../partials/head.php');

$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query);


// fetch post data from db with id set 
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . WEBSITE_URL . 'admin/manage-posts.php');
    die();
}
?>

<body>
    <div class="website-wrapper">
        <?php
        include('../partials/header.php');
        ?>
        <main class="main-content section-wrapper">
            <div class="section-content-wide">
                <div class="section-gap">
                    <div class="post-section">
                        <div class="sign-container">
                            <h2>Edit Post</h2>
                            <form action="<?= WEBSITE_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data"
                                method="POST">
                                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
                                <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title">
                                <select name="category">
                                    <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                                        <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                    <?php endwhile ?>
                                </select>
                                <textarea name="body" rows="10" placeholder="Body"><?= $post['body'] ?></textarea>
                                <div class="form-control inline">
                                    <input type="checkbox" id="is_featured" name="is_featured" value="1" checked>
                                    <label for="is_featured">Featured</label>
                                </div>
                                <div class="form-control">
                                    <label for="thumbnail">Update Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail">
                                </div>
                                <button type="submit" name="submit" class="btn">Update Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php
    include('../partials/scripts.php');
    ?>
</body>

</html>