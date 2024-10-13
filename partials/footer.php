<footer class="footer section-wrapper mt-base">
  <div class="section-content-wide">
    <div class="section-gap">
      <?php
      $categories_query = "SELECT * FROM categories";
      $categories_result = mysqli_query($connection, $categories_query);
      ?>
      <?php while ($category = mysqli_fetch_assoc($categories_result)): ?>
        <a href="<?= WEBSITE_URL ?>category-posts.php?id=<?= $category['id'] ?>"
          class="btn footer-btn"><?= $category['title'] ?></a>
      <?php endwhile ?>
    </div>
  </div>
</footer>

<?php
include('partials/scripts.php');
?>