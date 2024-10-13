<!DOCTYPE html>
<html lang="en">

<?php
include('partials/head.php');

if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";
  $posts = mysqli_query($connection, $query);
} else {
  header('location: ' . WEBSITE_URL . 'index.php');
  die();
}

?>

<body>
  <?php
  include('partials/header.php');
  ?>
  <div class="website-wrapper">
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

          <h2 class='mt-base'><?= $category_title ?></h2>

          <?php if (mysqli_num_rows($posts) > 0): ?>

            <div class="card-grid mt-base">
              <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                <article class="card">
                  <div class="card-gap">
                    <h2>
                      <a href="<?= WEBSITE_URL ?>post.php?id=<?= $post['id'] ?>" class="card-title-link">
                        <?= $post['title'] ?>
                      </a>
                    </h2>
                    <p>
                      <?= substr($post['body'], 0, 120) ?>...
                    </p>
                    <?php
                    // fetch author using author_id 
                    $author_id = $post['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>
                    <h6>
                      <i class="fa-solid fa-user"></i>
                      <?= "{$author['firstname']} {$author['lastname']}" ?>
                    </h6>
                    <small>
                      <i class="fa-solid fa-calendar-days"></i>
                      <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                    </small>

                    <div class="card-actions">
                      <a class="card-action-link" href="<?= WEBSITE_URL ?>post.php?id=<?= $post['id'] ?>">
                        <span>Read</span>
                        <i class="fa-solid fa-circle-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </article>
              <?php endwhile ?>
            </div>

          <?php else: ?>
            <div class="alert-msg error">
              <p>No posts found for this category</p>
            </div>
          <?php endif ?>


        </div>
      </div>
    </main>
    <?php
    include('partials/footer.php');
    ?>
  </div>

</body>

</html>