<?php

require '../database.php';

$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$user_type = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

// check for valid input 
if (!$firstname) {
    $_SESSION['edit-user'] = "Insert a first name please";
} elseif (!$lastname) {
    $_SESSION['edit-user'] = "Insert a last name please";
} else {
    // update user 
    $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', user_type=$user_type WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (mysqli_errno($connection)) {
        $_SESSION['edit-user-success'] = "Failed to update user.";
    } else {
        $_SESSION['edit-user-success'] = "User $firstname $lastname updated successfully";
    }
}

header('location: ' . WEBSITE_URL . 'admin/manage-users.php');
die();

