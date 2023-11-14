
<?php
require_once 'init.php';
require_once 'functions.php';


?>

<?php 

    $isLoggedIn = checkIfLoggedIn();

    if( $isLoggedIn )
    {
        include_once 'view-jobs.php';
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Work</title>
</head>
<body>

    <h1>WELCOME TO FIND WORK</h1>

</body>
</html>