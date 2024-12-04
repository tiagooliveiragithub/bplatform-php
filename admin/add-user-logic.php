<?php
require '../database.php';

// get form data if submit button was clicked
if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user_type = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // validate input values 
    if (!$firstname) {
        $_SESSION['add-user'] = "Please insert your first name";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please insert your last name";
    } elseif (!$username) {
        $_SESSION['add-user'] = "Please insert your username";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please insert your email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-user'] = "Password should have more than 8 characters";
    } else {
        // checking if passwords dont match 
        if ($createpassword !== $confirmpassword) {
            $_SESSION['add-user'] = "The passwords don't match";
        } else {
            // hashing the password 
            $hased_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // checking if username or email already exist 
            $user_check_query = "SELECT * FROM users WHERE (username='$username' OR email='$email')";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "Username or Email already exist";
            }
        }
    }

    // redirect to add-user page if we any problem 
    if (isset($_SESSION['add-user'])) {
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . WEBSITE_URL . 'admin/add-user.php');
        die();
    } else {
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, user_type) VALUES ('$firstname', '$lastname', '$username', '$email', '$hased_password', '$user_type')";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            //redirect to login page with success message
            $_SESSION['add-user-success'] = "New user $firstname $lastname created successfully.";
            header('location: ' . WEBSITE_URL . 'admin/manage-users.php');
            die();
        } else {
            die(mysqli_error($connection));
        }
    }

} else {
    header('location: ' . WEBSITE_URL . 'admin/add-user.php');
    die();
}