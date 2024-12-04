<!DOCTYPE html>
<html lang="en">

<?php
include('../partials/head.php');

$permission = 'admin';
include('partials/permission.php');

// get back form data if was any error 
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

// delete signup data session 
unset($_SESSION['add-user-data']);

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
                            <h2>Add User</h2>
                            <?php if (isset($_SESSION['add-user'])): ?>
                                <div class="alert-msg error">
                                    <p>
                                        <?= $_SESSION['add-user'];
                                        unset($_SESSION['add-user']);
                                        ?>
                                    </p>
                                </div>
                            <?php endif ?>
                            <form action="<?= WEBSITE_URL ?>admin/add-user-logic.php" enctype="multipart/form-data"
                                method="POST">
                                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
                                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
                                <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
                                <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
                                <input type="password" name="createpassword" value="<?= $createpassword ?>"
                                    placeholder="Create Passowrd">
                                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>"
                                    placeholder="Confirm Passowrd">
                                <select name="userrole">
                                    <option value="0">Viewer</option>
                                    <option value="1">Author</option>
                                    <option value="2">Admin</option>
                                </select>
                                <button type="submit" name="submit" class="btn">Add User</button>
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