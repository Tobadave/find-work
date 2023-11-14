<?php

    require_once 'init.php';
    require_once 'functions.php';

    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();
    checkIfNotLoggedInAndRedirect($redirectUrl);

    $user_info = fetchUserDetails('id', $_SESSION['id']);

    if ( $user_info === false )
    {
        loadErrorPage('USER NOT FOUND', 'NO USER FOUND');
        exit;
    }
    
    if ( $user_info['role'] !== 'employeer' )
    {
        loadErrorPage('NOT AUTHORISED', 'This page cannot be accessed by You.', 403);
        exit;
    }

?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>Create a New Job Opening - FindWork</title>
</head>
<body>
    
    <div class="container">

        <?php include_once 'assets/layouts/sidebar.php' ?>


        <div class="right">

            <?php include_once 'assets/layouts/navbar2.php' ?>

            <div class="contents">

                <form method="post" action="assets/php/create_job_logic.php" class="edit-profile-form" >

                    <section>
                        <div class="heading">
                            <h1><i class="fas fa-plus-circle"></i> Create New Job Opening.</h1>
                            <br>
                            <p> Post a new job opening to the public...</p>
                        </div>
    
                        <br>
                        <hr>
                        <br>
                    </section>

                    <div class="input">
                        <label for="">job title</label>
                        <input type="text" name="job_title" placeholder="Job Title">
                    </div>

                    <div class="input">
                        <label for="">description</label>
                        <textarea name="job_description" id="" cols="30" rows="10" placeholder="Description for the job"></textarea>
                    </div>

                    <div class="input">
                        <label for="">Skill <br> <small>seperate each skill with a comma(,)</small> </label>
                        <input type="text" name="job_skills" placeholder="Skills you are in need of?...">
                    </div>

                    <div class="input">
                        <label for="">Location</label>
                        <input type="text" name="job_location" placeholder="Where is your job located?...">
                    </div>

                    <div class="input">
                        <label for="">salary</label>
                        <input type="number" name="job_salary" value="0">
                    </div>

                    <div class="input">
                        <label for="">Deadline</label>
                        <input type="date" name="job_end_date">
                    </div>

                    <div class="input">
                        <button type="submit">Post This Job</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>