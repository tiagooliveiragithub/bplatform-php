<!DOCTYPE html>
<html lang="en">


<?php
include('../partials/head.php');

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . WEBSITE_URL . 'manage-users.php');
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
                            <h2>Edit User</h2>
                            <?php if (isset($_SESSION['edit-user'])): ?>
                                <div class="alert-msg error">
                                    <p>
                                        <?= $_SESSION['edit-user'];
                                        unset($_SESSION['edit-user']);
                                        ?>
                                    </p>
                                </div>
                            <?php endif ?>
                            <form action="<?= WEBSITE_URL ?>admin/edit-user-logic.php" method="POST">
                                <input type="hidden" value="<?= $user['id'] ?>" name="id">
                                <input type="text" value="<?= $user['firstname'] ?>" name="firstname"
                                    placeholder="First Name">
                                <input type="text" value="<?= $user['lastname'] ?>" name="lastname"
                                    placeholder="Last Name">
                                <select name="userrole">
                                    <option value="0">Author</option>
                                    <option value="1">Admin</option>
                                </select>
                                <button type="submit" name="submit" class="btn">Update User</button>
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