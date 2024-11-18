<!DOCTYPE html>
<html lang="en">

<?php
include('../partials/head.php');

if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE author_id=$id ORDER BY date_time DESC";
  $posts = mysqli_query($connection, $query);
} else {
  header('location: ' . WEBSITE_URL . 'general/index.php');
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

          <?php
          // fetch category using category_id of the post 
          $author_id = $id;
          $author_query = "SELECT * FROM users WHERE id=$id";
          $author_result = mysqli_query($connection, $author_query);
          $author = mysqli_fetch_assoc($author_result);
          $author_name = $author['firstname'] . ' ' . $author['lastname'];
          ?>

          <h2 class='mt-base'><?= $author_name ?> Posts</h2>

          <?php
          include('partials/posts-grid.php');
          ?>

        </div>
      </div>
    </main>
    <?php
    include('partials/categories.php');
    ?>
  </div>
  <?php
  include('../partials/scripts.php');
  ?>

</body>

</html>