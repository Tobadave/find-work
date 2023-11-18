<?php 
    // Include necessary files and functions
    require_once 'init.php';
    require_once 'functions.php';

    $redirectUrl = 'login.php';
    checkIfNotLoggedInAndRedirect($redirectUrl);

    if( !isset($_COOKIE['registration_status']) )
    {
        redirect('signup.php');
        exit;
    }
?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>Welcome User - Find Work</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

    <div class="container">
            <div class=" justify-content-center login-container">
                <div class="col-md-12 col-lg-10 w-100 row">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                            <div class="text w-100">
                                <h2> <i class="fas fa-user"></i> Welcome to FindWork</h2>
                                <p>Your sure place to get your next best GIG</p>
                            </div>
                        </div>
                    </div>

                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex header">
                            <div class="w-100">
                                <h3 class="mb-4">My Information</h3>
                            </div>
                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-facebook"></span></a>
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-twitter"></span></a>
                                </p>
                            </div>
                        </div>
                        <form action="assets/php/signup_logic.php" method="post" class="signin-form" id="jsForm" >
                            <div class="form-group mb-3">
                                <label class="label" for="name"> <i class="fas fa-user"></i> First Name</label>
                                <input class="fill" style="width: 300px;" type="text" placeholder="Enter First Name" name="fname" data-attr-name="fname" id="" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="name"> <i class="fas fa-user"></i> Last Name</label>
                                <input class="fill" style="width: 300px;" type="text" placeholder="Enter Last Name" name="lname" data-attr-name="lname" id="" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="name"> <i class="fas fa-phone"></i> Phone Number</label>
                                <input class="fill" style="width: 300px;" type="tel" placeholder="Enter Phone number" name="tel" data-attr-name="tel" id="" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="name"> 
                                    <div>
                                    <i class="fas fa-toolbox"></i> Skills
                                    </div>
                                    <p>
                                        <small>
                                            Seperate each with a comma(,)
                                        </small>
                                    </p>
                                </label>
                                <input class="fill" style="width: 300px;" type="text" placeholder="Enter your skills..." name="skills" data-attr-name="skills" id="" required>

                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="name"> 
                                    <div>
                                        <i class="fas fa-school"></i> Education History
                                    </div>
                                    <p>
                                        <small>
                                            Seperate each with a comma(,)
                                        </small>
                                    </p>
                                </label>
                                <input class="fill" style="width: 300px;" type="tel" placeholder="Enter your previous and current education insitutions..." name="education" data-attr-name="education" id="" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="name"> <i class="fas fa-link"></i> Resume URL</label>
                                <input class="fill" style="width: 300px;" type="tel" placeholder="Paste your resume or LinkedIn URL here..." name="resume_url" data-attr-name="resume_url" id="">

                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Continue To Profile <i class="fas fa-arrow-right"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

    <script>

        const form = document.getElementById('jsForm');

        // Example form details object
        const formDetails = {
            form: form,
            isErrorMessageInline: true,
        };

        // Example AJAX options object
        const ajaxOptions = {
            url: "assets/php/signup_logic.php",
            RequestMethod: "POST",
            RequestHeader: {
                "Content-Type": "application/json",
            },
        };

        // Forge a customized NFSFU234 Form Validation instance
        const formValidator = new NFSFU234FormValidation(formDetails, ajaxOptions);

        formValidator.submit();

        const submitBtn = form.querySelector('button');
        submitBtn.addEventListener('click',  ()=>{

            let responsePromise = formValidator.getAJAXResponse();

            responsePromise 
                .then((response) => {
                // Success: Server response received in JSON format

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

                        const returnURL = `dashboard.php`;

                        window.location.href = returnURL;


                    }, 5000);

                }

                formValidator.displayError(errorDetails);

            });
        });

    </script>

</body>
</html>