<?php

    require_once 'init.php';
    require_once 'functions.php';

    $redirectUrl = 'signup.php';
    checkIfNotLoggedInAndRedirect($redirectUrl);

    if( !isset($_COOKIE['registration_status']) )
    {
        redirect('signup.php');
        exit;
    }

?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>SignUp Page - FindWork</title>
    <link rel="stylesheet" href="assets/css/login.css">

</head>
<body>

    <div class="container">
                <div class=" justify-content-center signup-container">
                    <div class="col-md-12 col-lg-10 w-100 row">
                        <div class="wrap d-md-flex">
                            <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                                <div class="text w-100">
                                    <h2> <i class="fas fa-toolbox"></i> Welcome to FindWork. We hope you enjoy your while Here with us</h2>
                                    <p>Fill in the required information and start finding the next clients to your next job opening.</p>
                                </div>
                            </div>
                        </div>

                        <div class="login-wrap p-4 p-lg-5">
                            <div class="d-flex header">
                                <div class="w-100">
                                    <h3 class="mb-4">Company Information</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-facebook"></span></a>
                                        <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form action="assets/php/signup_logic.php" method="post" class="signin-form">
                                <div class="form-group mb-3">
                                <label for="">Employer Name</label>
                                <input type="text" placeholder="Full name" name="emp_name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <!-- <label class="label" for="name"> <i class="fas fa-evelope"></i> Email</label> -->
                                    <input type="hidden" placeholder="Your business email" name="emp_email" value="<?php echo fetchUserDetails('id', $_SESSION['id'])['email']; ?>" required>

                                </div>
                                <div class="form-group mb-3">
                                <label for="">Comapny Name</label>
                            <input type="text" placeholder="Your company name" name="emp_comp_name" required>
                                </div>
                                <div class="form-group mb-3">
                                <label for="">Company Field</label>
                            <input type="text" placeholder="Your company's field..." name="emp_feild" required>
                                </div>
                                <div class="form-group mb-3">
                                <label for="">Location</label>
                            <input type="text" placeholder="Location.." name="emp_location" required>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">CONTINUE TO PROFILE &#8594;</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
    
</body>
</html>