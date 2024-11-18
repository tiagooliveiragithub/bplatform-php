<?php if (isset($_SESSION['add-category-success'])): ?>
  <div class="alert-msg success">
    <p>
      <?= $_SESSION['add-category-success'];
      unset($_SESSION['add-category-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['edit-category-success'])): ?>
  <div class="alert-msg success">
    <p>
      <?= $_SESSION['edit-category-success'];
      unset($_SESSION['edit-category-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['delete-category-success'])): ?>
  <div class="alert-msg success">
    <p>
      <?= $_SESSION['delete-category-success'];
      unset($_SESSION['delete-category-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['delete-category'])): ?>
  <div class="alert-msg error">
    <p>
      <?= $_SESSION['delete-category'];
      unset($_SESSION['delete-category']);
      ?>
    </p>
  </div>
<?php endif ?>