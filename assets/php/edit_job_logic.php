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

    if ( isset($_POST["update_job"]) )
    {

        $name = $_POST['company_name'];
        $title = $_POST['job_title'];
        $description = $_POST['job_description'];
        $salary = $_POST['salary'];
        $skills = $_POST['skills'];
        $location = $_POST['location'];
        $close_date = $_POST['job_due_date'];

        $job_id = $_POST['job_id'];
        $url = $_POST['url'];

        $jobDetailsFromDb = fetchUserDetails('job_id', $job_id, 'jobs');

        // Array to track if each update operation was successful
        $shouldContinue = [];

        if ( !empty($title) && $title !== $jobDetailsFromDb['job_title'] )
        {

            if( updateItem('jobs', 'job_title', $title, 'job_id', $job_id) )
            {
                array_push($shouldContinue, true);
            }
            else
            {
                array_push($shouldContinue, false);
            }

        }
        else
        {
            array_push($shouldContinue, true);
        }

        if ( !empty($description) && $description !== $jobDetailsFromDb['job_description'] )
        {

            if( updateItem('jobs', 'job_description', $description, 'job_id', $job_id) )
            {
                array_push($shouldContinue, true);
            }
            else
            {
                array_push($shouldContinue, false);
            }

        }
        else
        {
            array_push($shouldContinue, true);
        }

        if ( !empty($salary) && $salary !== $jobDetailsFromDb['job_salary'] )
        {

            if( updateItem('jobs', 'job_salary', $salary, 'job_id', $job_id) )
            {
                array_push($shouldContinue, true);
            }
            else
            {
                array_push($shouldContinue, false);
            }

        }
        else
        {
            array_push($shouldContinue, true);
        }

        if ( !empty($skills) && $skills !== $jobDetailsFromDb['job_skills'] )
        {

            if( updateItem('jobs', 'job_skills', $skills, 'job_id', $job_id) )
            {
                array_push($shouldContinue, true);
            }
            else
            {
                array_push($shouldContinue, false);
            }

        }
        else
        {
            array_push($shouldContinue, true);
        }

        if ( !empty($location) && $location !== $jobDetailsFromDb['job_location'] )
        {

            if( updateItem('jobs', 'job_location', $location, 'job_id', $job_id) )
            {
                array_push($shouldContinue, true);
            }
            else
            {
                array_push($shouldContinue, false);
            }

        }
        else
        {
            array_push($shouldContinue, true);
        }

        if ( !empty($close_date) && $close_date !== $jobDetailsFromDb['job_end_date'] )
        {

            if( updateItem('jobs', 'job_end_date', $close_date, 'job_id', $job_id) )
            {
                array_push($shouldContinue, true);
            }
            else
            {
                array_push($shouldContinue, false);
            }

        }
        else
        {
            array_push($shouldContinue, true);
        }

        // Check if all update operations were successful
        $allTrue = array_reduce($shouldContinue, function ($carry, $item) {
            return $carry && $item;
        }, true);

        // echo true;

        // Redirect based on the success of update operations
        if ($allTrue) {
            header('Location: ' . $url . '&code=200&message=Successfully_Updated');
        } else {
            header('Location: ' . $url . '&code=200&message=An_Error_Occurred_Please_Try_Again_Later');
        }

    }

?>