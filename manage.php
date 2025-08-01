<?php
    // Include necessary files and functions
    require_once 'init.php';
    require_once 'functions.php';

    // Set the redirect URL to the login page with the current page URL as a parameter
    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();

    // Check if the user is not logged in and redirect to the login page if necessary
    checkIfNotLoggedInAndRedirect($redirectUrl);

    // Fetch user details based on the user's ID stored in the session
    $userDetails = fetchUserDetails('id', $_SESSION['id']);

    // Get the user's role from the fetched details
    $userRole = $userDetails['role'];

    // Initialize userDetails1 variable
    $userDetails1 = [];

    // Based on the user's role, fetch additional details from the respective table
    if ($userRole === 'client') {
        $userDetails1 = fetchUserDetails('applicant_email', $userDetails['email'], 'applicants');
    } elseif ($userRole === 'employeer') {
        $userDetails1 = fetchUserDetails('employer_email', $userDetails['email'], 'employers');
    }

    // Check if user details or additional details are not found
    if ($userDetails === false || $userDetails1 === false) {
        // Load the error page and exit if there is an issue with user details
        loadErrorPage(
            'USER NOT FOUND',
            "USER exists in the users table but not in its respective table, and we require info from there. Kindly report this to admin. <br> <a href='index.php'>Go To Home Page</a>"
        );
        exit;
    }

    // Extract and set variables based on the user's role
    if ($userRole === 'client') {
        $firstName = $userDetails1['applicant_first_name'];
        $lastName = $userDetails1['applicant_last_name'];
        $email = $userDetails1["applicant_email"];
        $phone_number = $userDetails1['applicant_phone_number'];
        $skills = $userDetails1['applicant_skills'];
        $education = $userDetails1['applicant_education_history'];
        $resume_url = $userDetails1['applicant_resume_url'];
    } elseif ($userRole === 'employeer') {
        $employer_name = $userDetails1['employer_name'];
        $company_name = $userDetails1['company_name'];
        $company_email = $userDetails1['employer_email'];
        $company_field = $userDetails1['employer_feild'];
    }
?>


<?php include_once 'assets/layouts/head.php' ?>

    <title>Edit My Profile - FindWork</title>
</head>
<body>
    
    <div class="container">

         <?php include_once 'assets/layouts/sidebar.php' ?>


        <div class="right">

            <?php include_once 'assets/layouts/navbar2.php' ?>


            <div class="contents">

                <form method="post" action="assets/php/manage_logic.php" class="edit-profile-form" id="info_form" >

                    <section>
                        <div class="heading">
                            <h1><i class="fas fa-user-cog"></i> Manage My Profile.</h1>
                            <br>
                            <p>Make Updates to my  profile...</p>
                        </div>
    
                        <br>
                        <hr>
                        <br>
                    </section>

                    <section>

                        <div class="heading">
                            <h3><i class="fas fa-user-cog"></i> Change My personal information.</h3>
                            <br>
                            <p>Want to make updates to your personal info?</p>
                        </div>
    
                        <br>
                        <hr>
                        <br>

                        <?php if( $userRole === 'client' ): ?>

                        <div class="input-group">

                            <div class="input">
                                <label for="">first Name</label>
                                <input type="text" name="fname" data-attr-name="fname" value="<?php echo $firstName ;?>">
                            </div>

                            <div class="input">
                                <label for="">last Name</label>
                                <input type="text" name="lname" data-attr-name="lname" value="<?php echo $lastName ;?>">
                            </div>

                        </div>

                        <div class="input">
                            <label for="">Email</label>
                            <input type="text" name="email" data-attr-name="email" value="<?php echo $email ;?>">
                        </div>

                        <div class="input">
                            <label for="">phone number</label>
                            <input type="tel" name="phone" data-attr-name="phone" value="<?php echo $phone_number ;?>">
                        </div>

                        <div class="input">
                            <label for="">Resume Link</label>
                            <input type="url" name="resume_url" data-attr-name="resume_url" value="<?php echo $resume_url ;?>">
                        </div>

                        <div class="input">
                            <input type="hidden" data-attr-name="usr_info" value="">
                        </div>

                        <div class="input">
                            <br>
                            <button type="submit" name="usr_info" > <i class="fas fa-user"></i> Update my information</button>
                        </div>

                        <?php elseif( $userRole === 'employeer' ):  ?>

                        <div class="input">
                            <label for=""> <i class="fas fa-box"></i> Company Name</label>
                            <input type="text" name="comp_name" data-attr-name="comp_name" value="<?php echo $company_name ?>">
                        </div>

                        <div class="input">
                            <label for=""> <i class="fas fa-building"></i> company feild</label>
                            <input type="text" name="comp_feild" data-attr-name="comp_feild" value="<?php echo $company_field ?>">
                        </div>

                        <div class="input">
                            <label for=""> <i class="fas fa-envelope"></i> company email</label>
                            <input type="text" name="comp_email" data-attr-name="comp_email"  value="<?php echo $company_email ?>">
                        </div>

                        <div class="input">
                            <label for=""> <i class="fas fa-user"></i> employeer name</label>
                            <input type="text" name="comp_employer_name" data-attr-name="comp_employer_name" value="<?php echo $employer_name ?>">
                        </div>

                        <div class="input">
                            <input type="hidden" data-attr-name="emp_info" value="">
                        </div>

                        <div class="input">
                            <button type="submit" name="emp_info" > <i class="fas fa-user"></i> Update my information</button>
                        </div>

                        <?php endif; ?>


                    </section>
                </form>

                <br>

                <form method="post" action="assets/php/manage_logic.php" class="edit-profile-form" id="manage_password" >

                    <section>

                        <div class="heading">
                            <h3><i class="fas fa-user-cog"></i> Change My Password.</h3>
                            <br>
                            <p>Want to make updates to your password?</p>
                        </div>
    
                        <br>
                        <hr>
                        <br>

                        <div class="input">
                            <label for=""> <i class="fas fa-lock"></i> Old Password</label>
                            <input type="password" name="old_pass" data-attr-name="old_pass">
                        </div>

                        <div class="input">
                            <label for=""> <i class="fas fa-unlock-keyhole"></i> New Password</label>
                            <input type="password" name="new_pass" data-attr-name="new_pass">
                        </div>

                        <div class="input">
                            <label for=""><i class="fas fa-unlock-keyhole"></i> Confirm New Password</label>
                            <input type="password" name="con_pass" data-attr-name="con_pass">
                        </div>

                        <div class="input">
                            <input type="hidden" data-attr-name="password_info" value="">
                        </div>

                        <div class="input">
                            <button type="submit"  name="password_info"> <i class="fas fa-lock"></i> Update my password</button>
                        </div>

                    </section>



                </form>

            </div>

        </div>

    </div>

    <script>

        const infoForm = document.getElementById('info_form');

        // Example form details object
        const infoFormDetails = {
            form: infoForm,
            isErrorMessageInline: true,
        };

        // Example AJAX options object
        const infoFormAjaxOptions = {
            url: "assets/php/manage_logic.php",
            RequestMethod: "POST",
            RequestHeader: {
                "Content-Type": "application/json",
            },
        };

        // Forge a customized NFSFU234 Form Validation instance
        const infoFormValidator = new NFSFU234FormValidation(infoFormDetails, infoFormAjaxOptions);

        infoFormValidator.submit();

        const infoFormSubmitBtn = infoForm.querySelector('button');
        infoFormSubmitBtn.addEventListener('click',  ()=>{

            let responsePromise = infoFormValidator.getAJAXResponse();

            responsePromise 
                .then((response) => {
                // Success: Server response received in JSON format

                if( response.status !== 200 )
                {
                    errorDetails = {
                        type : 'modal',
                        message: response.message,
                        duration: 3000,
                        element: infoForm,
                        success: false,
                    }
                }
                else
                {
                    errorDetails = {
                        type : 'modal',
                        message: response.message,
                        duration: 3000,
                        element: infoForm,
                        success: true,
                    }                    
                }

                formValidator.displayError(errorDetails);

            });

            

        });

    </script>

    <script>

        const passwordForm = document.getElementById('manage_password');

        // Example form details object
        const formDetails = {
            form: passwordForm,
            isErrorMessageInline: true,
        };

        // Example AJAX options object
        const ajaxOptions = {
            url: "assets/php/manage_logic.php",
            RequestMethod: "POST",
            RequestHeader: {
                "Content-Type": "application/json",
            },
        };

        // Forge a customized NFSFU234 Form Validation instance
        const formValidator = new NFSFU234FormValidation(formDetails, ajaxOptions);

        formValidator.submit();

        const submitBtn = passwordForm.querySelector('button');
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
                        element: passwordForm,
                        success: false,
                    }
                }
                else
                {
                    errorDetails = {
                        type : 'modal',
                        message: response.message,
                        duration: 3000,
                        element: passwordForm,
                        success: true,
                    }                    
                    formValidator.reset();
                }

                formValidator.displayError(errorDetails);

            });

            

        });

    </script>

</body>
</html>