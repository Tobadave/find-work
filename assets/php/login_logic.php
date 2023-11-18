<?php
    session_start();
    require_once '../../functions.php';

    include_once("db.php");

    // $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();
    // checkIfNotLoggedInAndRedirect($redirectUrl);
    

if ($_SERVER["REQUEST_METHOD"] === "POST")
{

    $requestData = json_decode(file_get_contents('php://input'), true);

    $username = $requestData['username'];
    $password = $requestData['pass'];

    $redirect_url = $requestData['r_url'];

    $redirect_url = parse_url($redirect_url, PHP_URL_QUERY);

    $params = array();

    parse_str($redirect_url, $params);

    $redirect_url = ( isset($params['redirect']) && filter_var( $params['redirect'], FILTER_VALIDATE_URL ) !== false ) ? $params['redirect'] : $redirect_url;

    if(!empty($username) && !empty($password))
    {

        $query = "SELECT * FROM users WHERE email=?";

        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $results = mysqli_stmt_get_result($stmt);

        if ( mysqli_num_rows($results) !== 1 )
        {
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'User Not Found',
            );
            echo json_encode($response);
            exit;
        }

        $results = mysqli_fetch_assoc($results);

        $paassword_from_db = $results['password'];


        if ( ! password_verify($password, $paassword_from_db) )
        {
            // echo "PASSWORD IS NOT CORRECT";
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'Password is not correct',
            );
            echo json_encode($response);
            exit;
        }

        loginUser($results['id'], $username);

        http_response_code(200);
        $response = array(
            "status" => 200,
            "message" => 'Login Successfull. Kindly wait as we redirect You.',
        );
        echo json_encode($response);
        exit;
        
    }
    else
    {
        http_response_code(200);
        $response = array(
            "status" => 400,
            "message" => 'Empty Fields',
        );
        echo json_encode($response);
        exit;
    }
}

?>