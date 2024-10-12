<!DOCTYPE html>
<html lang="en">

<?php include('pages/partials/head.php');

// get back form data if was any error 
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

// delete signup data session 
unset($_SESSION['signup-data']);
?>
<div class="website-wrapper">

  <body>
    <main class="main-content section-wrapper">
      <div class="section-content-wide">
        <div class="section-gap">
          <div class="sign-section">
            <div class="form-container">
              <h2>Sign Up</h2>
              <?php
              if (isset($_SESSION['signup'])): ?>
                <div class="alert-msg error">
                  <p>
                    <?=
                      $_SESSION['signup'];
                    unset($_SESSION['signup']);
                    ?>
                  </p>
                </div>
              <?php endif ?>
              <form action="<?= WEBSITE_URL ?>signup-logic.php" method="POST">
                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Password">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>"
                  placeholder="Confirm Password">
                <button type="submit" name="submit" class="btn">Sign Up</button>
                <small>Already have an account? <a href="signin.php">Sign In</a></small>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
</div>

<?php
include('pages/partials/footer.php');
?>
</body>

</html>