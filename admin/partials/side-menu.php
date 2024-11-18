<button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
<button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>

<aside>
  <ul>
    <li><a href="<?= WEBSITE_URL ?>admin/add-post.php"><i class="uil uil-pen"></i>
        <h5>Add Post</h5>
      </a></li>
    <li><a href="<?= WEBSITE_URL ?>admin/manage-posts.php"><i class="uil uil-postcard"></i>
        <h5>Manage Post</h5>
      </a></li>
    <?php if (isset($_SESSION['user_is_admin'])): ?>
      <li><a href="<?= WEBSITE_URL ?>admin/add-user.php"><i class="uil uil-user"></i>
          <h5>Add User</h5>
        </a></li>
      <li><a href="<?= WEBSITE_URL ?>admin/manage-users.php"><i class="uil uil-users-alt"></i>
          <h5>Manager Users</h5>
        </a></li>
      <li><a href="<?= WEBSITE_URL ?>admin/add-category.php"><i class="uil uil-edit"></i>
          <h5>Add Category</h5>
        </a></li>
      <li><a href="<?= WEBSITE_URL ?>admin/manage-categories.php"><i class="uil uil-list-ul"></i>
          <h5>Manage Categories</h5>
        </a></li>
    <?php endif ?>
  </ul>
</aside>