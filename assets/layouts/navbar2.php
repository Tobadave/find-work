<div class="navbar">

<div></div>

<div class="nav-items">


<?php if( checkIfLoggedIn() ): ?>

    <a href="dashboard.php" class="nav-item">
        <i class="fas fa-dashboard"></i>
        Go To Dashboard
    </a>

<?php endif; ?>

    <a href="manage.php" class="nav-item">
        <i class="fas fa-user"></i>
        my profile
    </a>

    <?php if( checkIfLoggedIn() ): ?>

        <form action="logout.php" class="nav-item bg-danger">
            <button>logout</button>
        </form>

    <?php endif; ?>

</div>

</div>