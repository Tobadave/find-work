<?php 

    require_once 'init.php';
    require_once 'functions.php';

    // $isLoggedIn = (checkIfLoggedIn() === true) ? true : 'false';

    echo checkIfLoggedIn();

    checkIfLoggedInAndRedirect('jobposting.php');



?>


<?php include_once 'assets/layouts/head.php' ?>
    <title>Login Page</title>
</head>
<body>

    <container class="navbar">
    <div style="display: flex; align-items: center; border-right: 1px solid rgb(2, 96, 2); padding-right: 40px;">
        <img class="logo" src="assets/images/findwork.png" alt="">
        <text style="color: rgb(2, 96, 2); font-weight: bold; font-size: 30px;">FindWORK</text>
        

    </div>
        <div style="font-size: 15px; font-weight: normal; :hover{cursor: pointer;} display:none; visibility: hidden;">
            <text>
                My Profile
            </text>
            <text style="margin-left: 20px;">
                LogOut
            </text>
        </div>

    </container>
    
    <div class="main">
            <div class="form" style="width: auto; height: 330px; padding-top: 70px; box-shadow: 5px 5px 10px rgba(49, 49, 49, 0.3); border: 1px solid rgba(0, 0, 0, 0.221); background-color: rgba(167, 167, 167, 0.111);">
                <!-- <div class="left-section" style="flex: 10px;">
                </div> -->
                <form action="assets/php/login_logic.php" method="POST">
                <div class="right-section" style="padding: 20px 0px; flex: 100px; padding: 10px 50px;">

                    <center><h3 style="color: rgb(2, 43, 10)">USER LOGIN</h3></center>
                    <div style="display: flex; flex-direction: column;">
                    <input class="fill" style="width: 300px;" type="text" placeholder="Username or email" name="username" required>
                    <input class="fill" style="width: 300px;" type="password" placeholder="Password" name="pass" id="" required>
                    <input type="hidden" name="r_url" value="<?php echo getCurrentPageURL() ?>">

                </div>
                <input type="submit" value="Login" style="width: 100px; padding: 5px; color: #000; float: left; border-radius: 10px; border: 
                none; background-color: rgb(2, 43, 10);color: white;font-weight: bold; padding: 10px 20px;">
                <text style="font-size: 15px; margin-left: 10px;">New User? <a href="signup.php">Create New Account</a></text>

                    <!-- <div style="display: inline; float: right; margin-right: 60px;">
                    New User?  <button style="">SIGN UP</button> -->
                </div>
            </form>
            </div>
        </div>
    </div>

</body>
</html>