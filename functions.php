<?php


    include("assets/php/db.php");


?>

<?php

function redirect($url)
{
    if ( empty($url) )
    {
        echo "URL CANNOT BE EMPTY";
        return false;
    }

    header("Location: $url");
}


/**
 * This function is used to check if a user is logged in
 */
function checkIfLoggedIn()
{


    if(isset($_SESSION['id']) && isset($_SESSION['name']))
    {
        return true;
    }

    return false;

}

function checkIfLoggedInAndRedirect( $url )
{

    if ( checkIfLoggedIn() === true )
    {
        redirect($url);
    }


}


function checkIfNotLoggedInAndRedirect( $url )
{

    if ( checkIfLoggedIn() === false )
    {
        redirect($url);
    }

}

function getCurrentPageURL()
{

    $protocol = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];

    $url = $protocol . $host . $uri;

    return $url;

}


function fetchAllUsers()
{

    $query = "SELECT * FROM login_form";

    $stmt = mysqli_prepare($con, $query);
    // mysqli_stmt_bind_param($stmt, "s", $value);
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);

    if ( mysqli_num_rows($results) === 0 )
    {
        echo "NO USER FOUND IN DATABASE";
        exit;
    }

    $results = mysqli_fetch_assoc($results);

    return $results;


}

function fetchUserDetails($columnName = 'mail', $value)
{

    include("assets/php/db.php");

    $query = "SELECT * FROM login_form WHERE $columnName=?";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $value);
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);

    if ( mysqli_num_rows($results) !== 1 )
    {
        echo "USER NOT FOUND";
        exit;
    }

    $results = mysqli_fetch_assoc($results);

    return $results;


}

function loadErrorPage($title, $message, $code = 500)  {
    
    $_SESSION['error_page_'] = random_int(1, 100);
    $_SESSION['error_page_title'] = $title;
    $_SESSION['error_page_message'] = $message;
    $_SESSION['error_page_code'] = $code;

    header('Location error.php?returnURL=' . getCurrentPageURL() );

}

?>