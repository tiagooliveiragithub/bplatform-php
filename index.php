<!DOCTYPE html>
<html lang="en">

<?php
include('pages/partials/head.php');

// fetch featured post from db 
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// fetch 9 posts from db 
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
$posts = mysqli_query($connection, $query);

?>

<body>
  <?php
  include('pages/partials/header.php');
  ?>
  <main>
    <div class="website-wrapper">
      <main class="main-content section-wrapper">
        <div class="section-content-wide">
          <div class="section-gap">

            <h2 class="mt-base">Trending</h2>

            <!-- show featured post if any exist  -->
            <?php if (mysqli_num_rows($featured_result) == 1): ?>
              <section class="featured">
                <article class="card">
                  <div class="card-text-wrapper">
                    <?php
                    // fetch category using category_id of the post 
                    $category_id = $featured['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                    $category_title = $category['title'];
                    ?>
                    <a href="<?= WEBSITE_URL ?>category-posts.php?id=<?= $category['id'] ?>"><?= $category['title'] ?></a>
                    <div class="card-title-wrapper">
                      <h2><a href="<?= WEBSITE_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a>
                      </h2>
                    </div>
                    <div class="card-content-wrapper">
                      <p class="card-content">
                        <?= substr($featured['body'], 0, 200) ?>...
                      </p>
                      <?php

                      // fetch author using author_id 
                      $author_id = $featured['author_id'];
                      $author_query = "SELECT * FROM users WHERE id=$author_id";
                      $author_result = mysqli_query($connection, $author_query);
                      $author = mysqli_fetch_assoc($author_result);
                      ?>

                      <div>
                        <h6><?= "{$author['firstname']} {$author['lastname']}" ?></h6>
                        <small><?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?></small>
                      </div>

                      <div class="card-actions">
                        <a class="card-action-link" href="<?= WEBSITE_URL ?>post.php?id=<?= $featured['id'] ?>">
                          <span>Read</span>
                          <i class="fa-solid fa-circle-arrow-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </article>
              </section>
            <?php endif ?>

            <h2 class="mt-base">Articles</h2>

            <div class="card-grid mt-base">

              <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                <article class="card">
                  <div class="card-text-wrapper">
                    <div class="card-title-wrapper">
                      <h2 class="card-title">
                        <a href="<?= WEBSITE_URL ?>post.php?id=<?= $post['id'] ?>" class="card-title-link">
                          <?= $post['title'] ?>
                        </a>
                      </h2>
                    </div>
                    <div class="card-content-wrapper">
                      <p class="card-content">
                        <?= substr($post['body'], 0, 120) ?>...
                      </p>

                      <div class="">
                        <?php
                        // fetch author using author_id 
                        $author_id = $post['author_id'];
                        $author_query = "SELECT * FROM users WHERE id=$author_id";
                        $author_result = mysqli_query($connection, $author_query);
                        $author = mysqli_fetch_assoc($author_result);
                        ?>
                        <div>
                          <h6><?= "{$author['firstname']} {$author['lastname']}" ?></h6>
                          <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
                        </div>
                      </div>

                      <div class="card-actions">
                        <a class="card-action-link" href="<?= WEBSITE_URL ?>post.php?id=<?= $post['id'] ?>">
                          <span>Read</span>
                          <i class="fa-solid fa-circle-arrow-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </article>
              <?php endwhile ?>
            </div>
          </div>
        </div>
      </main>
    </div>
  </main>

  <?php
  include('pages/partials/footer.php');
  ?>

</body>

</html>