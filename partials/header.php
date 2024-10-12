<header class="header">
  <div class="section-content-wide">
    <nav class="menu">
      <h1 class="menu-item">
        <a href="<?= WEBSITE_URL ?>"><i class="fa-brands fa-blogger-b"></i> Platform</a>
      </h1>
      <ul class="menu-items">
        <?php if (isset($_SESSION['user-id'])): ?>
          <li class="menu-item">
            <a href="<?= WEBSITE_URL ?>dashboard.php" class="menu-link"><i class="fa-solid fa-user"></i></a>
          </li>
          <li class="menu-item">
            <a href="<?= WEBSITE_URL ?>signout.php" class="menu-link"><i class="fa-solid fa-sign-out"></i></a>
          <?php else: ?>
          <li class="menu-item">
            <a href="<?= WEBSITE_URL ?>signin.php" class="menu-link"><i class="fa-solid fa-user"></i></a>
          </li>
        <?php endif ?>
        <li class="menu-item" id="theme-toggle">
          <a style="cursor: pointer;"><i id="theme-icon" class="fa-solid fa-moon"></i></a>
        </li>
      </ul>
    </nav>
  </div>
</header>