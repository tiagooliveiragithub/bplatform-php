<?php
// confirm if user has some value on the session value user_type redirect him to index
switch ($permission) {
  case 'admin':
    if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 'admin')) {
      header('location: ' . WEBSITE_URL . 'general/index.php');
      die();
    }
    break;
  case 'author':
    if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 'author' && $_SESSION['user_type'] != 'admin')) {
      header('location: ' . WEBSITE_URL . 'general/index.php');
      die();
    }
    break;
}

