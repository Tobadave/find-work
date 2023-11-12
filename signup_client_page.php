
<?php include_once 'assets/layouts/head.php' ?>

    <title>Welcome User </title>

    <style>
        input{
            height: 35px;
            border: none;
            outline: none;
        }
    </style>

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
                    <center><h3 style="color: rgb(2, 43, 10)">OTHER INFORMATION</h3></center>
                    <div style="display: flex; flex-direction: column;">
                    <input class="fill" style="width: 300px;" type="text" placeholder="Enter First Name" name="fname" id="">
                    <input class="fill" style="width: 300px;" type="text" placeholder="Enter Last Name" name="lname" id="">
                    <input class="fill" style="width: 300px;" type="tel" placeholder="Enter Phone number" name="c_pass" id="">

                </div>
                <center> <input value="next->" type="submit" class="button"></center>
            </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>