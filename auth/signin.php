<!DOCTYPE html>
<html lang="en">

<?php include('../partials/head.php');

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
?>

<body>
    <div class="website-wrapper">
        <main class="main-content section-wrapper">
            <div class="section-content-wide">
                <div class="section-gap">
                    <div class="sign-section">
                        <div class="form-container">
                            <h2>Sign In</h2>
                            <?php
                            if (isset($_SESSION['signup-success'])): ?>
                                <div class="alert-msg success">
                                    <p>
                                        <?= $_SESSION['signup-success'];
                                        unset($_SESSION['signup-success']);
                                        ?>
                                    </p>
                                </div>
                            <?php elseif (isset($_SESSION['signin'])): ?>
                                <div class="alert-msg error">
                                    <p>
                                        <?= $_SESSION['signin'];
                                        unset($_SESSION['signin']);
                                        ?>
                                    </p>
                                </div>
                            <?php endif ?>
                            <form action="<?= WEBSITE_URL ?>auth/signin-logic.php" method="POST">
                                <input type="text" name="username_email" value="<?= $username_email ?>"
                                    placeholder="Username or Email">
                                <div class="password-input">
                                    <input type="password" id="password" name="password" value="<?= $password ?>"
                                        placeholder="Password">
                                    <i class="fa fa-eye" id="togglePassword"></i>
                                </div>
                                <button type="submit" name="submit" class="btn">Sign In</button>
                                <small>Dont't have an account? <a href="<?= WEBSITE_URL ?>auth/signup.php">Sign
                                        Up</a></small>
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