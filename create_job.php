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

                <form method="post" action="assets/php/create_job_logic.php" class="edit-profile-form" id="create_job" >

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
                        <input type="text" name="job_title" placeholder="Job Title" data-attr-name="job_title" required>
                    </div>

                    <div class="input">
                        <label for="">description</label>
                        <textarea name="job_description" id="" cols="30" rows="10" data-attr-name="job_description" required placeholder="Description for the job"></textarea>
                    </div>

                    <div class="input">
                        <label for="">Skill <br> <small>seperate each skill with a comma(,)</small> </label>
                        <input type="text" name="job_skills" data-attr-name="job_skills" required placeholder="Skills you are in need of?...">
                    </div>

                    <div class="input">
                        <label for="">Location</label>
                        <input type="text" name="job_location" data-attr-name="job_location" required placeholder="Where is your job located?...">
                    </div>

                    <div class="input">
                        <label for="">salary</label>
                        <input type="number" name="job_salary" data-attr-name="job_salary" required value="0">
                    </div>

                    <div class="input">
                        <label for="">Deadline</label>
                        <input type="date" name="job_end_date" data-attr-name="job_end_date" required >
                    </div>

                    <div class="input">
                        <button type="submit">Post This Job</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>

        const form = document.getElementById('create_job');

        // Example form details object
        const formDetails = {
            form: form,
            isErrorMessageInline: true,
        };

        // Example AJAX options object
        const ajaxOptions = {
            url: "assets/php/create_job_logic.php",
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
                // console.log('Request successful', response);

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

                    formValidator.reset();
                    
                }

                formValidator.displayError(errorDetails);

            });

            

        });

    </script>

</body>
</html>