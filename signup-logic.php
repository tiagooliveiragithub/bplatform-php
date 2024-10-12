<?php
require 'database.php';

// Get signup form data if signup button was clicked
if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate input values
    if (!$firstname) {
        $_SESSION['signup'] = "Please insert your first name";
    } elseif (!$lastname) {
        $_SESSION['signup'] = "Please insert your last name";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please insert your username";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please insert your email";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['signup'] = "Password should have more than 8 characters";
    } else {
        // Checking if passwords don't match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['signup'] = "The passwords don't match";
        } else {
            // Hashing the password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // Checking if username or email already exists
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or Email already exists";
            } else {
                // Insert new user into the database
                $default_avatar = 'images/default-avatar.png';
                $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password,avatar, is_admin) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$default_avatar', 0)";
                $insert_user_result = mysqli_query($connection, $insert_user_query);

                if (!mysqli_errno($connection)) {
                    // Redirect to login page with success message
                    $_SESSION['signup-success'] = "Registration successful. Please log in!";
                    header('location: ' . WEBSITE_URL . 'signin.php');
                    die();
                } else {
                    die(mysqli_error($connection));
                }
            }
        }
    }

    // Redirect to signup page if there are any problems
    if (isset($_SESSION['signup'])) {
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . WEBSITE_URL . 'signup.php');
        die();
    }
} else {
    // Redirect to signup page if form was not submitted
    header('location: ' . WEBSITE_URL . 'signup.php');
    die();
}
