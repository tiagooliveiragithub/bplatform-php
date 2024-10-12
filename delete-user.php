<?php
require 'database.php';

if (isset($_GET['id'])) {

    // fetch user from db 
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // if (mysqli_num_rows($result) == 1) {
    //     $avatar_name = $user['avatar'];
    //     $avatar_path = 'images/' . $avatar_name;

    //     if ($avatar_path) {
    //         unlink($avatar_path);
    //     }
    // }

    // later we have to get all the posts and thumbnails and delete them too 
    // $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
    // $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    // if (mysqli_num_rows($thumbnails_result) > 0) {
    //     while ($thumbnail = mysqli_fetch_assoc($thumbnail_result)) {
    //         $thumbnail_path = 'images/' . $thumbnail['thumbnail'];

    //         // delete thumbnail from images folder is exist 
    //         if ($thumbnail_path) {
    //             unlink($thumbnail_path);
    //         }
    //     }
    // }


    // delete user from db 
    $delete_user_query = "DELETE FROM users WHERE id=$id LIMIT 1";
    $delete_user_result = mysqli_query($connection, $delete_user_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Problem deleting '{$user['firstname']}' '{$user['lastname']}'";
    } else {
        $_SESSION['delete-user-success'] = "User {$user['firstname']} {$user['lastname']} deleted successfully";
    }
}

header('location: ' . WEBSITE_URL . 'manage-users.php');
die();