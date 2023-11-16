<?php 

    require_once 'init.php';

    if ( ! isset($_SESSION['error_page_']) )
    {
        header('Location: index.php');
        exit;
    }
    
    $error_code = isset($_SESSION['error_page_code']) && !empty($_SESSION['error_page_code']) ? $_SESSION['error_page_code'] : 500;
    $error_error_message =  isset($_SESSION['error_page_message']) && !empty($_SESSION['error_page_message']) ? $_SESSION['error_page_message'] : 'An Error Occured. Kindly Contact The Admin';
    $error_title =  isset($_SESSION['error_page_title']) && !empty($_SESSION['error_page_title']) ? $_SESSION['error_page_title'] : 'An Error Occured. Kindly Contact The Admin';

    // http_response_code($error_code);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="assets/images/findwork.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $error_title; ?> - FindWork</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body
        {
            height: 100%;
        }

        body
        {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* color: red; */
        }

        .icon
        {

            width: 120px;
            height: 120px;
            color: red;

            display: flex;
            align-items: center;
            justify-content: center;

        }

        .icon svg 
        {
            fill: currentColor;
            width: 90%;
            height: 90%;
        }

        .message
        {
            text-transform: uppercase;
            font-size: 1.5rem;
            width: 95%;
            text-wrap: wrap;
            text-align: center;
            line-height: 45px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        .btn
        {
            text-decoration: none;
            color: green;
            font-size: 20px;
            /* display: block; */
            margin: 10px;
            display: inline-flex;
        }

        .btn svg
        {
            margin: 0 5px;
        }

    </style>
    <script src="http://localhost/@itms/fontawesome-free-6.4.0-web/js/all.min.js"></script>

</head>
<body>
    
    <div class="icon">
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path d='M11.29,15.71A1,1,0,0,0,13,15a1.05,1.05,0,0,0-.29-.71,1,1,0,0,0-1.09-.21,1,1,0,0,0-.33.21A1.05,1.05,0,0,0,11,15,1,1,0,0,0,11.29,15.71Zm8.62-.2H15.38a1,1,0,0,0,0,2h2.4A8,8,0,0,1,4,12a1,1,0,0,0-2,0,10,10,0,0,0,16.88,7.23V21a1,1,0,0,0,2,0V16.5A1,1,0,0,0,19.91,15.51ZM12,2A10,10,0,0,0,5.12,4.77V3a1,1,0,0,0-2,0V7.5a1,1,0,0,0,1,1H8.62a1,1,0,0,0,0-2H6.22A8,8,0,0,1,20,12a1,1,0,0,0,2,0A10,10,0,0,0,12,2Zm0,11a1,1,0,0,0,1-1V9a1,1,0,0,0-2,0v3A1,1,0,0,0,12,13Z'/></svg>
    </div>

    <div class="message">
        <?php echo $error_error_message; ?>
    </div>

    <div>
        <a href="index.php" class="btn" > <i class="fas fa-home"></i> Go Home</a>
        <a href="dashboard.php" class="btn" > <i class="fas fa-dashboard"></i> Go To Dashboard</a>
    </div>

</body>
</html>

<?php unset($_SESSION['error_page_']); ?>