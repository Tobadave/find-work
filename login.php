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
                    <div class="text-wrap p-4 p-lg-5  d-flex align-items-center order-md-last">
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
                    <form action="assets/php/login_logic.php" method="post" class="signin-form" id="login" >
                        <div class="form-group mb-3">
                            <label class="label" for="name"> <i class="fas fa-envelope"></i> Email</label>
                            <input type="email" class="form-control" name="username" data-attr-name="username" placeholder="Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="password"> <i class="fas fa-lock"></i> Password</label>
                            <input type="password" class="form-control" name="pass" data-attr-name="pass" placeholder="Password" required>
                            <div class=" js-togglePassword">
                                Show Password
                            </div>
                        </div>
                        <input type="hidden" name="r_url" id="r_url" data-attr-name="r_url" value="<?php echo getCurrentPageURL(); ?>">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

    const form = document.getElementById('login');

        // Example custom error messages for your form
        const customErrorMessages = {
            "text": "EMPTY FIELD",
            "email": {
                "empty": "EMPTY EMAIL",
                "format": "The email is not in the right format",
            },
        };

        // Example form details object
        const formDetails = {
            form: form,
            isErrorMessageInline: true,
            customErrorMessages: customErrorMessages,
        };

        // Example AJAX options object
        const ajaxOptions = {
            url: "assets/php/login_logic.php",
            RequestMethod: "POST",
            RequestHeader: {
                "Content-Type": "application/json",
            },
        };

        // Forge a customized NFSFU234 Form Validation instance
        const formValidator = new NFSFU234FormValidation(formDetails, ajaxOptions);

        formValidator.submit();

            // This will be used to toggle the visibility of an input feild with type of password
        formValidator.togglePasswordVisibility( 
            {
                show: "Show Password",
                hide: "Hide Password",
            }
        );

        const submitBtn = form.querySelector('button');
        submitBtn.addEventListener('click',  ()=>{

            let responsePromise = formValidator.getAJAXResponse();

            responsePromise 
                .then((response) => {
                // Success: Server response received in JSON format
                console.log('Request successful', response);

                if( response.status !== 200 )
                {
                    errorDetails = {
                        type : 'modal',
                        message: response.message,
                        duration: 3000,
                        element: form,
                        success: false,
                    }
                }
                else
                {
                    errorDetails = {
                        type : 'modal',
                        message: response.message,
                        duration: 3000,
                        element: form,
                        success: true,
                    }
                    setTimeout(() => {

                        const queryParams = new URLSearchParams(window.location.search);
                        const returnURL = queryParams.get('redirect');

                        if ( returnURL && returnURL !== '' )
                        {
                            window.location.href = returnURL;
                        }
                        else
                        {
                            window.location.href = "dashboard.php";
                        }

                    }, 5000);
                    
                }

                formValidator.displayError(errorDetails);

            })

            

        });

    </script>

</body>
</html>