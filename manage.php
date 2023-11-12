<?php

require_once 'init.php';
require_once 'functions.php';

    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();
    checkIfNotLoggedInAndRedirect($redirectUrl);

    $userData = fetchUserDetails('id', $_SESSION['id']);

    $user_first_name = $userData['fname'];
    $user_last_name = $userData['lname'];
    $user_email = $userData['mail'];
    $user_phone_number = $userData['tel'];
    $user_password = $userData['pass'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="assets/css/navbar.css">
    <!-- <link rel="stylesheet" href="Application_form.css"> -->
    <link rel="stylesheet" href="assets/css/manage.css">

</head>
<body>
    <container class="navbar">
        <div style="display: flex; align-items: center; border-right: 1px solid rgb(2, 96, 2); padding-right: 40px;">
            <img class="logo" src="assets/images/findwork.png" alt="">
            <text style="color: rgb(2, 96, 2); font-weight: bold; font-size: 30px;">FindWORK</text>
        </div>

        <div class="center">
            <li><a href="">FEED</a></li>
            <li><a href=""> HOME</a></li>
            <li><a href=""> CONTACT US</a></li>


        </div>

            <div class="right">
                <li>
                    <a href="manage.php">My Profile</a>
                </li>
                <li style="margin-left: 20px;">
                    <a href="logout.php">Log out</a>
                </li>
            </div>
        </container>

    <div class="encap">

            <div class="form">
                <div class="grid">
                    <div class="top">
                        <div class="head1"> Manage your profile </div>
                        <div style="font-style: italic; color: green;">Here you can choose to update your profile</div>
                    </div>
                  <div style="border: 1px dashed rgba(128, 128, 128, 0.633);border-radius: 5px; margin: 10px; padding-bottom: 20px;">  
                    <div class="btm">
                        
                        <div class="lt">

                            <input class="fill" type="text" placeholder="firstname" value="<?php echo $user_first_name ?>" >
                            <input class="fill" type="text" placeholder="Telephone" value="<?php echo $user_phone_number ?>">
                            <input class="fill" type="text" placeholder="Email" value="<?php echo $user_email ?>">
                            

                        </div>
                        <div class="rt">
                            
                            <input class="fill" type="text" placeholder="lastname" value="<?php echo $user_last_name ?>" >
                            <input class="fill" type="text" placeholder="Resume link" value="">
                            <input class="fill" type="password" placeholder="password" value="<?php echo $user_password ?>" >

                        </div>
                    </div>

                    <div class="foot" style="padding: 0px 10px;">
                        <input class="fill" type="text" placeholder="Skills" style="width:100%;">
                    </div>

                    </div>
                    <div class="foot" style="justify-content: space-between; padding: 0px 10px; ">
                        <input type="file" style="visibility: hidden;" disabled >
                        <button class="edit">UPDATE</button>
                    </div>


                </div>
            </div>

    </div>

</body>
</html>