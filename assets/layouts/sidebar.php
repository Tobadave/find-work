<?php if( checkIfLoggedIn() && fetchUserDetails('id', $_SESSION['id'])['role'] !== 'client'  ): ?>
    <div class="left">

        <div class="header">
            <a href="index.php" class="logo">
                <img src="assets/images/findwork.png" alt="FindWork Logo">
            </a>
        </div>

        <div class="main">

            <a href="dashboard.php" class="sidenav-link">
                <div class="icon">
                    <i class="fas fa-dashboard"></i>
                </div>
                <div class="text">Dashboard</div>
            </a>

            <a href="manage.php" class="sidenav-link">
                <div class="icon">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="text">manage my profile </div>
            </a>

            <a href="create_job.php" class="sidenav-link">
                <div class="icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="text">post new job</div>
            </a>

            <a href="view_my_jobs.php" class="sidenav-link">
                <div class="icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="text">view all jobs posted</div>
            </a>

            <a href="view_my_jobs_approvals.php" class="sidenav-link">
                <div class="icon">
                    <i class="fas fa-id-badge"></i>
                </div>
                <div class="text">view all jobs pending approval</div>
            </a>

        </div>

        <div class="footer"></div>

    </div>

<?php else: ?>
    <div class="left">

<div class="header">
    <a href="index.php" class="logo">
        <img src="assets/images/findwork.png" alt="FindWork Logo">
    </a>
</div>

<div class="main">

    <a href="dashboard.php" class="sidenav-link">
        <div class="icon">
            <i class="fas fa-dashboard"></i>
        </div>
        <div class="text">Dashboard</div>
    </a>

    <a href="manage.php" class="sidenav-link">
        <div class="icon">
            <i class="fas fa-user-cog"></i>
        </div>
        <div class="text">manage my profile </div>
    </a>

    <a href="view-jobs.php" class="sidenav-link">
        <div class="icon">
            <i class="fas fa-plus-circle"></i>
        </div>
        <div class="text">apply for a new job</div>
    </a>

    <a href="dashboard.php" class="sidenav-link">
        <div class="icon">
            <i class="fas fa-table"></i>
        </div>
        <div class="text">view all my applied jobs</div>
    </a>

</div>

<div class="footer"></div>

</div>

<?php endif ?>