<?php 

    require_once 'init.php';
    require_once 'functions.php';

    checkIfLoggedInAndRedirect('dashboard.php');

?>


<?php include_once 'assets/layouts/head.php' ?>
    <title>Login Page - FindWork</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

    <div class="container">
        <div class=" justify-content-center login-container">
            <div class="col-md-12 col-lg-10 w-100 row">
                <div class="wrap d-md-flex">
                    <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                        <div class="text w-100">
                            <h2> <i class="fas fa-user"></i> Welcome to login</h2>
                            <p>Don't have an account?</p>
                            <a href="signup.php" class="btn btn-white btn-outline-white">Sign Up</a>
                            <a href="index.php" class="text-center display-block" style="margin: 15px 0;" > <i class="fas fa-home"></i> Go Home</a>
                        </div>
                    </div>
                </div>

                <div class="login-wrap p-4 p-lg-5">
                    <div class="d-flex header">
                        <div class="w-100">
                            <h3 class="mb-4">Sign In</h3>
                        </div>
                        <div class="w-100">
                            <p class="social-media d-flex justify-content-end">
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-facebook"></span></a>
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-twitter"></span></a>
                            </p>
                        </div>
                    </div>
                    <form action="assets/php/login_logic.php" method="post" class="signin-form">
                        <div class="form-group mb-3">
                            <label class="label" for="name"> <i class="fas fa-envelope"></i> Email</label>
                            <input type="text" class="form-control" name="username" placeholder="Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="password"> <i class="fas fa-lock"></i> Password</label>
                        <input type="password" class="form-control" name="pass" placeholder="Password" required>
                        </div>
                        <input type="hidden" name="r_url" value="<?php echo getCurrentPageURL(); ?>">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>