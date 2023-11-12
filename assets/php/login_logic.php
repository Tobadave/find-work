<?php
    session_start();

    include("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $username = $_POST['username'];
    $password = $_POST['pass'];

    $redirect_url = $_POST['r_url'];
    $redirect_url = parse_url($redirect_url, PHP_URL_QUERY);

    $params = array();

    parse_str($redirect_url, $params);

    $redirect_url = ( isset($params['redirect']) && filter_var( $params['redirect'], FILTER_VALIDATE_URL ) !== false ) ? $params['redirect'] : $redirect_url;

    // echo $username . "<br>";
    // echo $firstname . "<br>";
    // echo $lastname . "<br>";
    // echo $telephone . "<br>";
    // echo $password . "<br>";

    // exit;

    if(!empty($username) && !empty($password))
    {

        $query = "SELECT * FROM users WHERE email=?";

        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $results = mysqli_stmt_get_result($stmt);

        if ( mysqli_num_rows($results) !== 1 )
        {
            echo "USER NOT FOUND";
            exit;
        }

        $results = mysqli_fetch_assoc($results);

        // echo "<pre>";
        // var_dump($results);
        // echo "</pre>";

        $paassword_from_db = $results['password'];

        if ( ! password_verify($paassword_from_db, $password) )
        {
            echo "PASSWORD IS NOT CORRECT";
            exit;
        }

        echo "<h1>YOU ARE SUCCESSFULLY LOGGED IN. START SESSION CREATION</h1>";

        // session_start();

        $_SESSION['id'] = $results['id'];
        $_SESSION['name'] = $results['fname'] . $results['lname'];

        if ( isset($redirect_url) && ! empty( $redirect_url ) )
        {

            header("Location: $redirect_url " );

        }
        else
        {
            header("Location: ../../jobposting.php");
        }
        
    }
    else
    {
        echo "<script type='text/javascript'> alert('Please Enter some valid Information')</script>";
    }
}

?>