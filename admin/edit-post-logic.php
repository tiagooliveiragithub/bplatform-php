<?php
require '../database.php';

// make sure edit post button was clicked 
if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];


    // set is_featured to 0 if it was unchecked 
    $is_featured = $is_featured == 1 ?: 0;

    if (!$title) {
        $_SESSION['edit-post'] = "Problem updating post. Invalid form data";
    } elseif (!$category_id) {
        $_SESSION['edit-post'] = "Problem updating post. Invalid form data";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Problem updating post. Invalid form data";
    } else {
        // delete the existing thumbnail if new thumbnail is available 
        if ($thumbnail['name']) {
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if ($previous_thumbnail_path) {
                unlink($previous_thumbnail_path);
            }

            // working on the new thumbnail 
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            // make sure file is an image 
            $allowed_files = ['jpg', 'jpeg', 'png'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);

            if (in_array($extension, $allowed_files)) {
                if ($thumbnail['size'] < 2_000_000) {
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['edit-post'] = "The size of the file is too big (2MB max)";
                }
            } else {
                $_SESSION['edit-post'] = "The file should be jpg, jpeg or png";
            }
        }
    }

    if ($_SESSION['edit-post']) {
        // redirect to manage post page if form was invalid 
        header('location: ' . WEBSITE_URL . 'admin/manage-posts.php');
        die();
    } else {
        // set is_featured of all posts to 0 if is_featured is 1 in this post 
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        // set thumbnail name if a new one was uploaded, else keep old thumbnail name 
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

        $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
    }


    if (!mysqli_errno($connection)) {
        $_SESSION['edit-post-success'] = "Post updated successfully";
    }
}


header('location: ' . WEBSITE_URL . 'admin/manage-posts.php');
die();