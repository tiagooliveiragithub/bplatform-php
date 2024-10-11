<?php
require 'database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // check is_featured to 0 if is unchecked 
    $is_featured = $is_featured == 1 ? 1 : 0;

    // validate form data 
    if (!$title) {
        $_SESSION['add-post'] = "Insert a post title";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Insert the category for the post";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Insert the post body";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Choose a thumbnail for your post";
    } else {
        // working in the thumbnail 
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = 'images/' . $thumbnail_name;

        // make sure file is an image 
        $allowed_files = ['jpg', 'jpeg', 'png'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);

        if (in_array($extension, $allowed_files)) {
            if ($thumbnail['size'] < 2_000_000) {
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "The size of the file is too big (2MB max)";
            }
        } else {
            $_SESSION['add-post'] = "The file should be jpg, jpeg or png";
        }

    }

    // redirect back with the form data if any problem 
    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . WEBSITE_URL . 'add-post.php');
        die();
    } else {
        // set is_featured of all post to 0 if is_featured for this post is 1 
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        // insert post to db 
        $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES ('$title', '$body', '$thumbnail_name', $category_id, $author_id, $is_featured)";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "New post added successfully";
            header('location: ' . WEBSITE_URL . 'dashboard.php');
            die();
        }
    }
}

header('location: ' . WEBSITE_URL . 'add-post.php');
die();