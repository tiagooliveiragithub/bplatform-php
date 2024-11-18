<?php if (isset($_SESSION['add-user-success'])): ?>
  <div class="alert-msg success">
    <p>
      <?= $_SESSION['add-user-success'];
      unset($_SESSION['add-user-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['edit-user-success'])): ?>
  <div class="alert-msg success">
    <p>
      <?= $_SESSION['edit-user-success'];
      unset($_SESSION['edit-user-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['delete-user-success'])): ?>
  <div class="alert-msg success">
    <p>
      <?= $_SESSION['delete-user-success'];
      unset($_SESSION['delete-user-success']);
      ?>
    </p>
  </div>
<?php elseif (isset($_SESSION['delete-user'])): ?>
  <div class="alert-msg error">
    <p>
      <?= $_SESSION['delete-user'];
      unset($_SESSION['delete-user']);
      ?>
    </p>
  </div>
<?php endif ?>