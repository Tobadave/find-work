<?php

    require_once 'init.php';
    require_once 'functions.php';

    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();
    checkIfNotLoggedInAndRedirect($redirectUrl);

?>

<?php include_once 'assets/layouts/head.php' ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
</head>
<body>
    
    <container class="navbar">
    <div style="display: flex; align-items: center; border-right: 2px solid rgba(0, 0, 0, 0.4); padding-right: 40px;">
        <img class="logo" src="assets/images/findwork.png" alt="">
        <text style="color: rgb(2, 96, 2); font-weight: bold; font-size: 30px;">FindWORK</text>
        

    </div>
    <div class="right">
        <li>
            MY PROFILE
        </li>
        <li style="margin-left: 20px;">
            <form action="logout.php" method="post">
                <input type="submit" value="LOGOUT">
            </form>
        </li>
    </div>

    </container>

    <div class="main">
        <div class="form">
            <div class="left-section">
        </div>
        <div class="right-section">
    
            <h1 style="color: rgba(4, 55, 1, 0.885);">JOB APPLICATION FORM
                <br>
            <ok style="font-size: 20px;">(Python Back-end Application form)</ok>
            </h1>

            <p style="margin-top: 0px; font-style: italic; font-size: 15px;">Please fill in all input</p>

            <form action="">
            <input class="fill" style="width: 48%;" type="text" placeholder="First Name">
            <input  class="fill" style="width: 48%;"  type="text" placeholder="Last Name">
            <br>
            <input  class="fill" style="width: 48%;" type="email" placeholder="Email address" id="">
            <input class="fill" style="width: 48%;" type="tel" placeholder="Mobile">
            <br>
            <input class="fill" style="width: 98%;" type="tel" placeholder="Home Address">
            <br>
            <input  class="fill" style="width: 98%;" type="tel" placeholder="Education History">
            <br>
            <textarea class="fill" name="Skills" placeholder="Share your experiences/Projects as a pyhton developer" ></textarea>
            <br>
            <input class="fill" type="file" name="Resume" placeholder="FILE"><label for="Resume"> Upload Resume Copy</label>

            <button class="button" type="submit">Submit Application</button>
            </form>
        </div>
        </div>
    </div>
</body>
</html>