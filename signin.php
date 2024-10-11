<!DOCTYPE html>
<html lang="en">

<?php include('pages/partials/head.php'); 

    $username_email = $_SESSION['signin-data']['username_email'] ?? null;
    $password = $_SESSION['signin-data']['password'] ?? null;

    unset($_SESSION['signin-data']);
?>

<body>

<main class="main-content section-wrapper">
  <div class="sign-section section-content-wide">
      <div class="sign-container sign-form">
          <h2>Sign In</h2>
          <?php
          if(isset($_SESSION['signup-success'])) : ?>
              <div class="alert-msg success">
                  <p>
                      <?= $_SESSION['signup-success'];
                      unset($_SESSION['signup-success']);
                      ?>
                  </p>
              </div>
          <?php elseif (isset($_SESSION['signin'])) : ?>
          <div class="alert-msg error">
                  <p>
                      <?= $_SESSION['signin'];
                      unset($_SESSION['signin']);
                      ?>
                  </p>
              </div>
          <?php endif ?>  
          <form action="<?= WEBSITE_URL ?>signin-logic.php" method="POST">
            <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email">
            <input type="password" name="password" value="<?= $password ?>" placeholder="Password">
            <button type="submit" name="submit" class="btn">Sign In</button>
            <small>Dont't have an account? <a href="signup.php">Sign Up</a></small>
          </form>
    </div>
  </div>
</main>

<?php
include('pages/partials/footer.php');
?>
</body>

</html>