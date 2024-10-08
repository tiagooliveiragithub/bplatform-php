<?php
require('config.php');

$connection = new mysqli(
  DB_HOST,
  DB_USER,
  DB_PASSWORD,
  DB_NAME
);

if (mysqli_errno($connection)) {
  die('Failed to connect to the database: ' + mysqli_error($connection));
}