<?php
require '../database.php';

if (isset($_POST['submit'])) {
    // get data from the form 
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['signin'] = "Please insert a Username or a Email";
    } elseif (!$password) {
        $_SESSION['signin'] = "Please insert a Password";
    } else {
        // fetch user from database 
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            // converting the user into assoc array 
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            // compare form password with database password 
            if (password_verify($password, $db_password)) {
                // set session for access control 
                $_SESSION['user-id'] = $user_record['id'];
                // set session if user is an admin or author
                if ($user_record['user_type'] == 2) {
                    $_SESSION['user_type'] = "admin";
                } elseif ($user_record['user_type'] == 1) {
                    $_SESSION['user_type'] = "author";
                }
                // log user in 
                header('location: ' . WEBSITE_URL . 'general/index.php');
                die();

            } else {
                $_SESSION['signin'] = "Verify your information";
            }
        } else {
            $_SESSION['signin'] = "User not found";
        }

    }

    // if any problem, redirect back to signin page with login data
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . WEBSITE_URL . 'auth/signin.php');
        die();
    }

} else {
    header('location: ' . WEBSITE_URL . 'auth/signin.php');
    die();
}
