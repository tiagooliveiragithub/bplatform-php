<?php
require '../database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    // validating inputs 
    if (!$title || !$description) {
        $_SESSION['edit-category'] = "Insert a title and a description for your category";
    } else {
        $query = "UPDATE categories SET title='$title', description='$description' WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit-category'] = "Problem updating category";
        } else {
            $_SESSION['edit-category-success'] = "Category $title updated successfuly";
        }
    }
}

header('location: ' . WEBSITE_URL . 'admin/manage-categories.php');
die();