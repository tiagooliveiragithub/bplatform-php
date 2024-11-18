<!DOCTYPE html>
<html lang="en">

<?php
include('../partials/head.php');
// fetch categories from db 
$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);

?>

<body>
    <?php
    include('../partials/header.php');
    ?>
    <div class="website-wrapper">
        <main class="main-content section-wrapper">
            <div class="section-content-wide">
                <?php
                include('partials/messages-posts.php');
                ?>
                <section class="dashboard">
                    <div class="container dashboard__container">
                        <?php
                        include('partials/side-menu.php');
                        ?>
                        <main>
                            <h2>Manage Categories</h2>
                            <?php if (mysqli_num_rows($categories) > 0): ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                                            <tr>
                                                <td><?= $category['title'] ?></td>
                                                <td><a href="<?= WEBSITE_URL ?>edit-category.php?id=<?= $category['id'] ?>"
                                                        class="btn sm">Edit</a>
                                                </td>
                                                <td><a href="<?= WEBSITE_URL ?>delete-category.php?id=<?= $category['id'] ?>"
                                                        class="btn sm danger">Delete</a></td>
                                            </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert-msg error">No categories found</div>
                            <?php endif ?>
                        </main>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <?php
    include('../partials/scripts.php');
    ?>
</body>

</html>