<?php 
	session_start();
//	$db = mysqli_connect('localhost', 'root', '', 'crud');

    include_once 'db_connection.php';

	// initialize variables
	$state = "";
    $question_id = "";
    $regulated = "";
    $question = "";
    $options = "";
    $goto_if_yes = "";
    $goto_if_no = "";
    $company_code = "";
    
    //$id = 0;
    
	$update = false;

	if (isset($_POST['save'])) {
		$state = $_POST['state'];
        $question_id = $_POST['question_id'];
        $regulated = $_POST['regulated'];
        $question = $_POST['question'];
        $options = $_POST['options'];
        $goto_if_yes = $_POST['goto_if_yes'];
        $goto_if_no = $_POST['goto_if_no'];
        $company_code = $_POST['company_code'];

          // open connection to db
          $mysqli = OpenCon();

          $insert = $mysqli->query("INSERT INTO questions (state, question_id, regulated, question, options, goto_if_yes, goto_if_no, company_code )
          VALUES('$state','$question_id','$regulated','$question','$options','$goto_if_yes','$goto_if_no', '$company_code')");

          
        if (!$insert) {
            // if there is an error on the insert
            echo $mysqli->error;
        }


        //mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
        
		$_SESSION['message'] = "Question Info saved!"; 
		header('location: crud_questions.php');
	}

    if (isset($_POST['update'])) {
        $state = $_POST['state'];
        $question_id = $_POST['question_id'];
        $regulated = $_POST['regulated'];
        $question = $_POST['question'];
        $options = $_POST['options'];
        $goto_if_yes = $_POST['goto_if_yes'];
        $goto_if_no = $_POST['goto_if_no'];
        $company_code = $_POST['company_code'];

        // open connection to db
        $mysqli = OpenCon();

        $update = $mysqli->query("UPDATE company SET state='$state', question_id='$question_id', regulated='$$regulated', question='$question', options='$options', goto_if_yes='$goto_if_yes', goto_if_no='$goto_if_no', company_code='$company_code' WHERE state='$state' AND question_id='$question_id'");

        if (!$update) {
            // if there is an error on the update
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Question Updated!"; 
		header('location: crud_questions.php');
    }



    if (isset($_GET['del'])) {
        $company_code = $_GET['del'];
        
         // open connection to db
         $mysqli = OpenCon();

         $delete = $mysqli->query("DELETE FROM questions WHERE state='$state' AND question_id='$question_id'");

        if (!$delete) {
            // if there is an error on the delete
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Question deleted!"; 
		header('location: crud_questions.php');
    }


    ?>

