<!DOCTYPE html>
<html lang="en">

<?php
include('pages/partials/head.php');

if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query_views = "UPDATE posts SET views = views + 1 WHERE id=$id";
  mysqli_query($connection, $query_views);
  $query = "SELECT * FROM posts WHERE id=$id";
  $result = mysqli_query($connection, $query);
  $post = mysqli_fetch_assoc($result);
}
?>


<body>
  <?php
  include('pages/partials/header.php');
  ?>
  <main class="main-content section-wrapper">
    <div class="single-post-content section-content-narrow">
      <div class="single-post-gap section-gap">

        <?php if (isset($post['thumbnail'])): ?>
          <div class="single-post-cover pb-base">
            <img loading="lazy" src="images/<?= $post['thumbnail'] ?>" alt="<?= $post['title'] ?>">
          </div>
        <?php endif; ?>

        <h2 class="single-post-title pb-base center">
          <?= $post['title'] ?>
        </h2>

        <div class="post-meta">
          <div class="post-meta-item">
            <a class="post-meta-link" href="#">
              <i class="fa-solid fa-user"></i>
              <span>
                <div class="post__author">
                  <?php
                  // fetch author using author_id 
                  $author_id = $post['author_id'];
                  $author_query = "SELECT * FROM users WHERE id=$author_id";
                  $author_result = mysqli_query($connection, $author_query);
                  $author = mysqli_fetch_assoc($author_result);
                  ?>
                  <h6><?= "{$author['firstname']} {$author['lastname']}" ?></h6>
                </div>
              </span>
            </a>
          </div>
          <div class="post-meta-item">
            <span class="post-meta-link">
              <i class="fa-solid fa-calendar-days"></i>
              <span>
                <h6><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></h6>
              </span>
            </span>
          </div>
          <div class="post-meta-item">
            <span class="post-meta-link">
              <i class="fa-solid fa-eye"></i>
              <span>
                <h6><?= $post['views'] ?></h6>
              </span>
            </span>
          </div>
        </div>

        <div class="single-post-content pb-base">
          <pre><?= $post['body'] ?></pre>
        </div>

      </div>
  </main>


  <?php
  include('pages/partials/footer.php');
  ?>

</body>

</html>