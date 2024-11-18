<?php if (isset($_SESSION['add-post-success'])): ?>
  <div class="alert-msg success">
    <p>
      <?= $_SESSION['add-post-success'];
      unset($_SESSION['add-post-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['edit-post-success'])): ?>
  <div class="alert-msg success">
    <p>
      <?= $_SESSION['edit-post-success'];
      unset($_SESSION['edit-post-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['delete-post-success'])): ?>
  <div class="alert-msg success">
    <p>
      <?= $_SESSION['delete-post-success'];
      unset($_SESSION['delete-post-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['delete-post'])): ?>
  <div class="alert-msg error">
    <p>
      <?= $_SESSION['delete-post'];
      unset($_SESSION['delete-post']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['edit-post'])): ?>
  <div class="alert-msg error">
    <p>
      <?= $_SESSION['edit-post'];
      unset($_SESSION['edit-post']);
      ?>
    </p>
  </div>
<?php endif ?>