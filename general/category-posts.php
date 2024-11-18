<!DOCTYPE html>
<html lang="en">

<?php
include('../partials/head.php');

if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";
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
          $category_id = $id;
          $category_query = "SELECT * FROM categories WHERE id=$id";
          $category_result = mysqli_query($connection, $category_query);
          $category = mysqli_fetch_assoc($category_result);
          $category_title = $category['title'];
          ?>

          <h2 class='mt-base'><?= $category_title ?> Category</h2>

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