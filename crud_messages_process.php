<?php 
//ini_set('display_errors', 1);
	session_start();
//	$db = mysqli_connect('localhost', 'root', '', 'crud');

   // include_once 'db_connection.php';
    include_once 'global_functions.php';

	// initialize variables
	$state = "";
    $message_id = "";
    $regulated = "";
    $message = "";
    $company_code = "";
    
    //$id = 0;
    
	$update = false;

	if (isset($_POST['save'])) {
		$state = $_POST['state'];
        $message_id = $_POST['message_id'];
        $regulated = $_POST['regulated'];
        $message = $_POST['message'];
        $company_code = $_POST['company_code'];

          // open connection to db
          $mysqli = OpenCon();
        
          $insert = $mysqli->query("INSERT INTO messages (state, message_id, regulated, message, company_code )
          VALUES('$state','$message_id','$regulated','$message', '$company_code')");

          
        if (!$insert) {
            // if there is an error on the insert
            echo $mysqli->error;
        }


        //mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
        
		$_SESSION['message'] = "Message Info saved!"; 
		header('location: crud_messages.php');
	}

    if (isset($_POST['update'])) {
        $state = $_POST['state'];
        $message_id = $_POST['message_id'];
        $regulated = $_POST['regulated'];
        $message = $_POST['message'];
        $company_code = $_POST['company_code'];
        $rec_id = $_POST['rec_id'];

        // open connection to db
        $mysqli = OpenCon();
        $message = str_replace("'", "''", "$message");
        $update = $mysqli->query("UPDATE messages SET state='$state', message_id='$message_id', regulated='$regulated', message='$message', company_code='$company_code' WHERE rec_id='$rec_id'");

        if (!$update) {
            // if there is an error on the update
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Message Updated!"; 
		header('location: crud_messages.php');
    }



    if (isset($_GET['del'])) {
        $rec_id = $_GET['del'];
        
         // open connection to db
         $mysqli = OpenCon();

         $delete = $mysqli->query("DELETE FROM messages WHERE rec_id='$rec_id'");

        if (!$delete) {
            // if there is an error on the delete
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Message deleted!"; 
		header('location: crud_messages.php');
    }


    ?>

