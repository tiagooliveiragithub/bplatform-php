<?php
require 'database.php';

if (isset($_POST['submit'])) {
    // get form data 
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$title) {
        $_SESSION['add-category'] = "Enter a title";
    } elseif (!$description) {
        $_SESSION['add-category'] = "Enter a description";
    }

    // if was invalid inputs redirect to add category page 
    if (isset($_SESSION['add-category'])) {
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . WEBSITE_URL . 'add-category.php');
        die();
    } else {
        // insert category into db 
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $query);
        if (mysqli_errno($connection)) {
            $_SESSION['add-category'] = "Problem adding category";
            header('location: ' . WEBSITE_URL . 'add-category.php');
            die();
        } else {
            $_SESSION['add-category-success'] = "Category added successfully";
            header('location: ' . WEBSITE_URL . 'manage-categories.php');
            die();
        }
    }
}