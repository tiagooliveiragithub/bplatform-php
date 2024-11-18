<?php
require '../database.php';

if (isset($_GET['id'])) {

    // fetch user from db 
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // delete user from db 
    $delete_user_query = "DELETE FROM users WHERE id=$id LIMIT 1";
    $delete_user_result = mysqli_query($connection, $delete_user_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Problem deleting '{$user['firstname']}' '{$user['lastname']}'";
    } else {
        $_SESSION['delete-user-success'] = "User {$user['firstname']} {$user['lastname']} deleted successfully";
    }
}

header('location: ' . WEBSITE_URL . 'admin/manage-users.php');
die();