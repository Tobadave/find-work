<?php
require_once 'init.php';
require_once 'functions.php';

    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();
    checkIfNotLoggedInAndRedirect($redirectUrl);

?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>Job Posting</title>
    <link rel="stylesheet" href="assets/css/jobposting.css">
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
                    <form action="logout.php" method="post">
                        <button type="submit">Log out</button> 
                    </form>
                    <!-- <a href="logout.php">Log out</a> -->
                </li>
            </div>
        </container>

    <div class="content">
            <div class="form">
                <div class="left-section">
                    <div class="left-content">
                        <h2>JOB POSTING</h2>
                    </div>

                    <div class="vert"></div>
                </div>

                

            <div class="right-section">
                <div class="right-content">
                        <form action="Application_form.html">
                            <h2 style="color:rgb(0, 77, 0); text-transform: uppercase; margin: 0px; margin-top: 10px;">Python Back-end Developer needed</h2>
                            <hr>
                            <h3>Are you a senior python developer?</h3>
                        <div style="border: 1px dotted rgb(0, 41, 0); display: inline-block; margin-left: 30px; padding: 10px; padding-right: 50px; border-radius: 5px; background-color: rgb(227, 227, 227);">
                            <ul style="font-weight:500;">
                                <li>Good and familiar with Django framework</li>
                                <li>Good and familiar with Django framework</li>
                                <li>Good and familiar with Django framework</li>
                                <li>Be able to develop a standalone backend data facility</li>
                                <li>Good at problem solving skills</li>
                            </ul>
                        </div>
                            <h4>If this seems like a job for you, please Apply <a style="float: right;" href="Application_form.html">Click Here to apply for this Job</a> </h4>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>