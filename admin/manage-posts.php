<!DOCTYPE html>
<html lang="en">

<?php
include('../partials/head.php');

// fetch currents user posts from db 
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection, $query);

?>

<body>
  <?php
  include('../partials/header.php');
  ?>
  <div class="website-wrapper">
    <main class="main-content section-wrapper">
      <div class="section-content-wide">
        <section class="dashboard">
          <?php
          include('partials/messages-posts.php');
          ?>
          <div class="container dashboard__container">
            <?php
            include('partials/side-menu.php');
            ?>
            <main>
              <h2>Manage Posts</h2>
              <?php if (mysqli_num_rows($posts) > 0): ?>
                <table>
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                        <!-- getting category title for each post  -->
                        <?php
                        $category_id = $post['category_id'];
                        $category_query = "SELECT title FROM categories WHERE id=$category_id";
                        $category_result = mysqli_query($connection, $category_query);
                        $category = mysqli_fetch_assoc($category_result);
                        ?>
                        <td><?= $post['title'] ?></td>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= WEBSITE_URL ?>edit-post.php?id=<?= $post['id'] ?>" class="btn sm">Edit</a>
                        </td>
                        <td><a href="<?= WEBSITE_URL ?>delete-post.php?id=<?= $post['id'] ?>"
                            class="btn sm danger">Delete</a></td>
                      </tr>
                    <?php endwhile ?>
                  </tbody>
                </table>
              <?php else: ?>
                <div class="alert-msg error">No posts found</div>
              <?php endif ?>
            </main>
          </div>
        </section>
      </div>
    </main>
  </div>

  <?php
  include('../partials/scripts.php');
  ?>
</body>

</html>