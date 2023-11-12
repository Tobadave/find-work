
<?php include_once 'assets/layouts/head.php' ?>

    <title>SignUp Page</title>
</head>
<body>

    <container class="navbar">
        <div style="display: flex; align-items: center; border-right: 1px solid rgb(2, 96, 2); padding-right: 40px;">
            <img class="logo" src="assets/images/findwork.png" alt="">
            <text style="color: rgb(2, 96, 2); font-weight: bold; font-size: 30px;">FindWORK</text>
        </div>

        <!-- <div class="center">
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
            </div> -->
        </container>
    
    <div class="main">
            <div class="form" style="width: auto; height: auto; box-shadow: 5px 5px 10px rgba(49, 49, 49, 0.3); border: 1px solid rgba(0, 0, 0, 0.221); background-color: rgba(167, 167, 167, 0.111); ">
 
                <div class="right-section" style="padding: 20px 0px; flex: 100px; padding: 30px 50px;">

                <form action="assets/php/signup_logic.php" method="POST">
                    <center><h3 style="color: rgb(2, 43, 10)">SIGNUP</h3></center>

                    <div style="display: flex; flex-direction: column;">
                    <input class="fill" style="width: 300px;" type="email" placeholder="Email" name="email" id="">
                    <!-- <input class="fill" style="width: 300px;" type="text" placeholder="First Name" name="fname">
                    <input class="fill" style="width: 300px;" type="text" placeholder="Last Name" name="lname" id=""> -->
                    <!-- <input class="fill" style="width: 300px;" type="tel" placeholder="Telephone" name="tel" id=""> -->
                    <input class="fill" style="width: 300px;" type="password" placeholder="Password" name="pass" id="">
                    <input class="fill" style="width: 300px;" type="password" placeholder="Re-enter Password" name="c_pass" id="">



                    <div class="radio">
                        <div class="opt">
                            <input type="radio" id="option1" name="role" value="client">
                            <label for="option1">I am a Client</label>
                        </div>
                        
                        <div class="opt">
                            <input type="radio" id="option2" name="role" value="employeer">
                            <label for="option2">I am a Employeer</label>
                        </div>

                    </div>
                </div>
                <center> <input value="Create Account" type="submit" class="button"></center>
            </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>