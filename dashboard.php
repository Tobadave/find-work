<?php
require_once 'init.php';
require_once 'functions.php';

    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();
    checkIfNotLoggedInAndRedirect($redirectUrl);

    $userDetails = fetchUserDetails('id', $_SESSION['id']);


    if ( $userDetails === false )
    {
        loadErrorPage('USER NOT FOUND', 'NO USER FOUND');
        exit;
    }
    

?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>Dashboard - FindWork</title>
</head>
<body>
    
    <div class="container">

        <?php include_once 'assets/layouts/sidebar.php' ?>

        <div class="right">

            <?php include_once 'assets/layouts/navbar2.php' ?>


            <div class="contents">

                <div class="cards card-4 admin-dashboard">

                <?php if ( $userDetails['role'] === 'client' ): ?>

                    <a href="index.php" class="card">
                        <div class="icon">
                            <i class="fas fa-external-link"></i>
                        </div>
                        <div class="text">
                            go to home page
                        </div>
                    </a>

                    <a href="manage.php" class="card">
                        <div class="icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="text">
                            manage my profile
                        </div>
                    </a>

                    <a href="view-jobs.php" class="card">
                        <div class="icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="text">
                            apply for a job
                        </div>
                    </a>

                    <a href="#" class="card">
                        <div class="icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="text">
                            view all my applied jobs
                        </div>
                    </a>

                <?php else: ?>

                    <a href="index.php" target="_blank" class="card">
                        <div class="icon">
                            <i class="fas fa-external-link"></i>
                        </div>
                        <div class="text">
                            go to home page
                        </div>
                    </a>

                    <a href="manage.php" class="card">
                        <div class="icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="text">
                            manage my profile
                        </div>
                    </a>

                    <a href="create_job.php" class="card">
                        <div class="icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="text">
                            create new job posting
                        </div>
                    </a>

                    <a href="view_my_jobs.php" class="card">
                        <div class="icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="text">
                            view all my jobs posted
                        </div>
                    </a>

                    <a href="view_my_jobs_approvals.php" class="card">
                        <div class="icon">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        <div class="text">
                            view all job pending approval
                        </div>
                    </a>

                    <a href="view-jobs.php" target="_blank" class="card">
                        <div class="icon">
                            <i class="fas fa-external-link"></i>
                        </div>
                        <div class="text">
                            view all jobs available on the network
                        </div>
                    </a>

                    <?php endif; ?>

                    <form action="logout.php" method="post" class="card bg-danger">
                        <button type="submit" style="width: 100%; height: 100%;outline: none;border: none; background: transparent;color: inherit;">
                            <div class="icon">
                                <i class="fas fa-door-open"></i>
                            </div>
                            <div class="text">LOGOUT</div>
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</body>
</html>