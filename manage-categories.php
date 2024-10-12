<!DOCTYPE html>
<html lang="en">

<?php
include('pages/partials/head.php');
// fetch categories from db 
$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);

?>

<body>
    <?php
    include('pages/partials/header.php');
    ?>
    <div class="website-wrapper">
        <main class="main-content section-wrapper">
            <div class="section-content-wide">
                <section class="dashboard">
                    <?php if (isset($_SESSION['add-category-success'])): ?>
                        <div class="alert-msg success">
                            <p>
                                <?= $_SESSION['add-category-success'];
                                unset($_SESSION['add-category-success']);
                                ?>
                            </p>
                        </div>
                    <?php elseif (isset($_SESSION['edit-category-success'])): ?>
                        <div class="alert-msg success">
                            <p>
                                <?= $_SESSION['edit-category-success'];
                                unset($_SESSION['edit-category-success']);
                                ?>
                            </p>
                        </div>
                    <?php elseif (isset($_SESSION['delete-category-success'])): ?>
                        <div class="alert-msg success">
                            <p>
                                <?= $_SESSION['delete-category-success'];
                                unset($_SESSION['delete-category-success']);
                                ?>
                            </p>
                        </div>
                    <?php elseif (isset($_SESSION['delete-category'])): ?>
                        <div class="alert-msg error">
                            <p>
                                <?= $_SESSION['delete-category'];
                                unset($_SESSION['delete-category']);
                                ?>
                            </p>
                        </div>
                    <?php endif ?>
                    <div class="container dashboard__container">
                        <button id="show__sidebar-btn" class="sidebar__toggle"><i
                                class="uil uil-angle-right-b"></i></button>
                        <button id="hide__sidebar-btn" class="sidebar__toggle"><i
                                class="uil uil-angle-left-b"></i></button>
                        <aside>
                            <ul>
                                <li><a href="add-post.php"><i class="uil uil-pen"></i>
                                        <h5>Add Post</h5>
                                    </a></li>
                                <li><a href="index.php"><i class="uil uil-postcard"></i>
                                        <h5>Manage Post</h5>
                                    </a></li>
                                <?php if (isset($_SESSION['user_is_admin'])): ?>
                                    <li><a href="add-user.php"><i class="uil uil-user"></i>
                                            <h5>Add User</h5>
                                        </a></li>
                                    <li><a href="manage-users.php"><i class="uil uil-users-alt"></i>
                                            <h5>Manager Users</h5>
                                        </a></li>
                                    <li><a href="add-category.php"><i class="uil uil-edit"></i>
                                            <h5>Add Category</h5>
                                        </a></li>
                                    <li><a href="manage-categories.php" class="active"><i class="uil uil-list-ul"></i>
                                            <h5>Manage Categories</h5>
                                        </a></li>
                                <?php endif ?>
                            </ul>
                        </aside>
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
    </div>

    <?php
    include('pages/partials/footer.php');
    ?>
</body>

</html>