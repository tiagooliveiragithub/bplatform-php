<!DOCTYPE html>
<html lang="en">

<?php
include('../partials/head.php');

$permission = 'admin';
include('partials/permission.php');

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch category from db 
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
    }
} else {
    header('location: ' . WEBSITE_URL . 'admin/manage-categories');
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
                        <div class="form-container">
                            <h2>Edit Category</h2>
                            <form action="<?= WEBSITE_URL ?>admin/edit-category-logic.php" method="POST">
                                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                <input type="text" name="title" value="<?= $category['title'] ?>" placeholder="Title">
                                <textarea rows="4" name="description"
                                    placeholder="Description"><?= $category['description'] ?></textarea>
                                <button type="submit" name="submit" class="btn">Update Category</button>
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