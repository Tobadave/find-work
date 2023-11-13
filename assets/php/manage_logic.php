<?php
    // Include necessary files and functions
    include("../../init.php");
    include("../../functions.php");
?>

<?php
    // Check if the request method is not POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo "INCORRECT METHOD";
        exit;
    }

    // Check if the form with the name "emp_info" was submitted
    if (isset($_POST["emp_info"])) {
        // Fetch employer information from the database
        $compInfo = fetchUserDetails('employer_id', $_SESSION['id'], 'employers');

        // Retrieve updated employer information from the POST data
        $employer_name = $_POST['comp_employer_name'];
        $company_name = $_POST['comp_name'];
        $company_email = $_POST['comp_email'];
        $company_feild = $_POST['comp_feild'];

        // Get the user ID from the session
        $user_id = $_SESSION['id'];

        // Array to track if each update operation was successful
        $shouldContinue = [];

        // Update employer name if it's not empty and different from the current value
        if (!empty($employer_name) && $employer_name !== $compInfo['employer_name']) {
            if (updateItem('employers', 'employer_name', $employer_name, 'employer_id', $user_id)) {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
        } else {
            array_push($shouldContinue, true);
        }

        // Update company name if it's not empty and different from the current value
        if (!empty($company_name) && $company_name !== $compInfo['company_name']) {
            if (updateItem('employers', 'company_name', $company_name, 'employer_id', $user_id)) {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
        } else {
            array_push($shouldContinue, true);
        }

        // Update company field if it's not empty and different from the current value
        if (!empty($company_feild) && $company_feild !== $compInfo['employer_feild']) {
            if (updateItem('employers', 'employer_feild', $company_feild, 'employer_id', $user_id)) {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
        } else {
            array_push($shouldContinue, true);
        }

        // Update company email if it's not empty and different from the current value
        if (!empty($company_email) && $company_email !== $compInfo['employer_email']) {
            if (updateItem('users', 'email', $company_email, 'employer_id', $user_id)) {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
        } else {
            array_push($shouldContinue, true);
        }

        // Check if all update operations were successful
        $allTrue = array_reduce($shouldContinue, function ($carry, $item) {
            return $carry && $item;
        }, true);

        // Redirect based on the success of update operations
        if ($allTrue) {
            header('Location: ../../manage.php?code=200&message=Successfully_Updated');
        } else {
            header('Location: ../../manage.php?code=200&message=An_Error_Occurred_Please_Try_Again_Later');
        }
    }

    if ( isset($_POST['password_info']) )
    {

        // Get user info for password change
        $paassword_from_db = fetchUserDetails('id',$_SESSION ['id'])['password'];

        $old_password_from_user = $_POST['old_pass'];
        $new_password_from_user = $_POST['new_pass'];
        $confirm_password_from_user = $_POST['con_pass'];

        // Validate old password    

        if ( ! password_verify( $old_password_from_user , $paassword_from_db ) )
        {
            echo "Your Old Password does not match. Try again";
            exit;
        }

        if ( ! hash_equals( $new_password_from_user, $confirm_password_from_user ) )
        {
            echo "Your New Passwords Don't Match";
            exit;
        }

        $new_password_from_user = password_hash($new_password_from_user, PASSWORD_DEFAULT);

        // Update new password in database
        if (!updateItem('users','password',$new_password_from_user,'id',$_SESSION['id']))
        {
            echo "AN ERROR Occured and Your Password Could not be CHanged";
            exit;
        }

        echo "SUCCESS";
        header('Location: ../../manage.php?code=200&message=Password_Changed_Success');
        exit;
    }
        

?>
