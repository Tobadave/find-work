<?php 

    require_once 'init.php';
    require_once 'functions.php';

    $isLoggedIn = checkIfLoggedIn();

    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {

        session_start();

        if ( ! $isLoggedIn )
        {
            echo "YOU NEED TO BE LOGGED IN FIRST";
            exit;
        }

        unset($_SESSION['id']);
        unset($_SESSION['name']);
        redirect('login.php?message=logout_successful&code=200');

    }
    else
    {
        echo "USE THE RIGHT METHOD TO LOGOUT";
        exit;
    }





?>