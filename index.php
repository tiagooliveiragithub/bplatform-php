<!DOCTYPE html>
<html lang="en">

<?php
include('partials/head.php');

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
  include('partials/header.php');
  ?>
  <div class="website-wrapper">
    <main class="main-content section-wrapper">
      <div class="section-content-wide">
        <div class="section-gap">

          <!-- show featured post if any exist  -->
          <?php if (mysqli_num_rows($featured_result) == 1): ?>
            <h2 class="mt-base">Main Post</h2>
            <article class="card">
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
                  <a href="<?= WEBSITE_URL ?>category-posts.php?id=<?= $category['id'] ?>"><i class="fa-solid fa-tag"></i>
                    <?= $category['title'] ?></a>
                  <p style="margin: 0;"><i class="fa-solid fa-calendar-days"></i>
                    <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                  </p>
                </div>
                <h2>
                  <a href="<?= WEBSITE_URL ?>post.php?id=<?= $featured['id'] ?>">
                    <?= $featured['title'] ?>
                  </a>
                </h2>
                <?php if (isset($featured['thumbnail'])): ?>
                  <a href="<?= WEBSITE_URL ?>category-posts.php?id=<?= $category['id'] ?>">
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
                  <i class="fa-solid fa-user"></i>
                  <?= "{$author['firstname']} {$author['lastname']}" ?>
                </h5>
                <div class="card-actions">
                  <a class="card-action-link" href="<?= WEBSITE_URL ?>post.php?id=<?= $featured['id'] ?>">
                    <span>Read</span>
                    <i class="fa-solid fa-circle-arrow-right"></i>
                  </a>
                </div>
              </div>
            </article>
            </section>
          <?php endif ?>

          <h2 class="mt-base">Posts</h2>
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

        </div>
      </div>
    </main>
    <?php
    include('partials/footer.php');
    ?>
  </div>
</body>

</html>