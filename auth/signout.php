<?php
require '../config.php';


// destroy all the sessions and redirect user to home page 
session_destroy();
header('location: ' . WEBSITE_URL . 'general/index.php');
die();
