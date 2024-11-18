<!DOCTYPE html>
<html lang="en">

<?php
include('../partials/head.php');

// fetch featured post from db 
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// fetch 9 posts from db 
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 4";
$posts = mysqli_query($connection, $query);

?>

<body>
  <div class="website-wrapper">
    <?php
    include('../partials/header.php');
    ?>
    <main class="main-content section-wrapper">
      <div class="section-content-wide">
        <div class="section-gap">

          <!-- show featured post if any exist  -->
          <?php if (mysqli_num_rows($featured_result) == 1): ?>
            <h2 class="mt-base">Featured Post</h2>
            <article class="featured card">
              <div class="card-gap">
                <?php
                // fetch category using category_id of the post 
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                $category_title = $category['title'];
                // fetch author using author_id 
                $author_id = $featured['author_id'];
                $author_query = "SELECT * FROM users WHERE id=$author_id";
                $author_result = mysqli_query($connection, $author_query);
                $author = mysqli_fetch_assoc($author_result);
                ?>
                <div class="card-featured-header">
                  <a href="<?= WEBSITE_URL ?>general/category-posts.php?id=<?= $category['id'] ?>"><i
                      class="fa-solid fa-tag"></i>
                    <?= $category['title'] ?></a>
                  <p style="margin: 0;"><i class="fa-solid fa-calendar-days"></i>
                    <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                  </p>
                </div>
                <h2>
                  <a href="<?= WEBSITE_URL ?>general/post.php?id=<?= $featured['id'] ?>">
                    <?= $featured['title'] ?>
                  </a>
                </h2>
                <?php if (isset($featured['thumbnail'])): ?>
                  <a href="<?= WEBSITE_URL ?>general/post.php?id=<?= $category['id'] ?>">
                    <img loading="lazy" class="card-cover" src="<?= WEBSITE_URL ?>images/<?= $featured['thumbnail'] ?>"
                      alt="<?= $featured['title'] ?>">
                  </a>
                <?php endif; ?>
                <div class="mt-base">
                  <p>
                    <?= substr($featured['body'], 0, 200) ?>...
                  </p>
                </div>
                <h5 style="margin: 0;">
                  <a href="<?= WEBSITE_URL ?>general/author-posts.php?id=<?= $featured['author_id'] ?>">
                    <i class="fa-solid fa-user"></i>
                    <?= "{$author['firstname']} {$author['lastname']}" ?>
                  </a>
                </h5>
                <div class="card-actions">
                  <a class="card-action-link" href="<?= WEBSITE_URL ?>general/post.php?id=<?= $featured['id'] ?>">
                    <span>Read</span>
                    <i class="fa-solid fa-circle-arrow-right"></i>
                  </a>
                </div>
              </div>
            </article>
            </section>
          <?php endif ?>

          <h2 class="mt-base">Recent Posts</h2>

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