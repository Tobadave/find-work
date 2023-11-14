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

?>

<?php 

    //  FOr Approving a job request
    if ( isset($_POST['approve_candidate']) )
    {

        $job_id = $_POST['job_id'];
        $user_id = $_POST['user_id'];
        $url = $_POST['url'];

        if ( empty($job_id) || empty($user_id) )
        {
            echo "EMPTY FEILDS";
            exit;
        }

        $applications = fetchAllDataFromATable('applications');

        $target_id = $user_id;

        $filtered_jobs = array_filter($applications, function($item) use ($target_id){
            return $item['applicant_id'] == $target_id;
        } );
    
        $applicants = array_values($filtered_jobs);

        // echo "<pre>";
        // var_dump($applicants);
        // echo "</pre>";

        foreach ($applicants as $key => $applicant) {
            
            if ( $job_id === $applicant['job_id'] )
            {

                if ( updateItem('applications', 'status', 1, 'application_id', $applicant['application_id']) )
                {
                    redirect($url . '&code=200&message=APPROVED_SUCCESSFULLY');
                    exit;
                }
                else
                {
                    redirect($url . '&code=200&message=ERROR_OCCURED');
                    // echo "NOT UPDATED";
                    exit;
                }

            }
            else
            {
                // echo "NOTHING TO DO";
                redirect($url);
                exit;
            }

        }


    }


?>

<?php 

    // For rejecting a job request
    if ( isset($_POST['reject_candidate']) )
    {

        $job_id = $_POST['job_id'];
        $user_id = $_POST['user_id'];
        $url = $_POST['url'];

        if ( empty($job_id) || empty($user_id) )
        {
            echo "EMPTY FEILDS";
            exit;
        }

        $applications = fetchAllDataFromATable('applications');

        $target_id = $user_id;

        $filtered_jobs = array_filter($applications, function($item) use ($target_id){
            return $item['applicant_id'] == $target_id;
        } );
    
        $applicants = array_values($filtered_jobs);

        // echo "<pre>";
        // var_dump($applicants);
        // echo "</pre>";

        foreach ($applicants as $key => $applicant) {
            
            if ( $job_id === $applicant['job_id'] )
            {

                if ( updateItem('applications', 'status', 2, 'application_id', $applicant['application_id']) )
                {
                    redirect($url . '&code=200&message=REJECTED_SUCCESSFULLY');
                    exit;
                }
                else
                {
                    redirect($url . '&code=200&message=ERROR_OCCURED');
                    // echo "NOT UPDATED";
                    exit;
                }

            }
            else
            {
                // echo "NOTHING TO DO";
                redirect($url);
                exit;
            }

        }


    }

?>