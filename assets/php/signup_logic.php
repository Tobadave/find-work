<?php
    session_start();

    include("db.php");
    include("../../functions.php");

if ($_SERVER["REQUEST_METHOD"] === "POST")
{

    function createUser() {
        include("db.php");
        
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $confirm_password = $_POST['c_pass'];

        $role = $_POST['role'];

        if(!empty($email) && !empty($role) && !empty($password) &&!empty($confirm_password))
        {

            if ( !hash_equals($password, $confirm_password) )
            {
                echo "<script type='text/javascript'> alert('password is nto valid')</script>";
                header("Location: ../../signup.php");
                exit;
            }

            $id = generateRandomStrings(20, 'USER_ID_');
            $password = password_hash($password,  PASSWORD_DEFAULT);


            $query = "INSERT INTO users (email, password, id, role) VALUES(?, ?, ?, ?)";

            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $email, $password, $id, $role);

            // if ( mysqli_query($con, $query) )
            if (mysqli_stmt_execute($stmt) )
            {
                // echo "<script type='text/javascript'> alert('Sucessfully Register')</script>";

                // echo "<h1>LOGIN PAGE</h1>";

                loginUser($id, $email);

                // $_COOKIE['registration_status'] = 1;
                setcookie('registration_status', 1, 14000, '/');


                // session_set_cookie_params();

                header("Location: ../../signup_" . $role . "_page.php" );
                exit;

            }
            else
            {
                echo "<script type='text/javascript'> alert('not Registered')</script>";

            }
            
        }
        else
        {
            echo "<script type='text/javascript'> alert('Please Enter some valid Information')</script>";
        }

    }

    function createApplicant()
    {

        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $telephone = $_POST['tel'];

        // setcookie('registration_status', 1, 14000, '/');


    }

//    session_get_cookie_params();
    
    if (  isset($_COOKIE['registration_status']) && ! empty( $_COOKIE['registration_status'] )  )
    {
        createUser();

        
    }

    if ( isset($_COOKIE['registration_status']) || empty( $_COOKIE['registration_status'] ) || $_COOKIE['registration_status'] === 2  )
    {
        // createApplicant();
        echo "Create Applicant";
    }

    

}

?>