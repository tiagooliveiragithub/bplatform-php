<?php if (mysqli_num_rows($posts) > 0): ?>

  <div class="card-grid mt-base">
    <?php while ($post = mysqli_fetch_assoc($posts)): ?>

      <article class="card">
        <div class="card-gap">
          <h2>
            <a href="<?= WEBSITE_URL ?>general/post.php?id=<?= $post['id'] ?>" class="card-title-link">
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
            <a href="<?= WEBSITE_URL ?>general/author-posts.php?id=<?= $post['author_id'] ?>">
              <i class="fa-solid fa-user"></i>
              <?= "{$author['firstname']} {$author['lastname']}" ?>
            </a>
          </h6>
          <small>
            <i class="fa-solid fa-calendar-days"></i>
            <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
          </small>

          <div class="card-actions">
            <a class="card-action-link" href="<?= WEBSITE_URL ?>general/post.php?id=<?= $post['id'] ?>">
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
    <p>No posts found</p>
  </div>
<?php endif ?>