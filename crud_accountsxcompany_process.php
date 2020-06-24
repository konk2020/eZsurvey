<?php 
	session_start();
//	$db = mysqli_connect('localhost', 'root', '', 'crud');

    //include_once 'db_connection.php';
    include_once 'global_functions.php';

	// initialize variables
    $id = "";
	$company_code = "";
    
    //$id = 0;
    
	$update = false;

	if (isset($_POST['save'])) {
		$id = $_POST['id'];
		$company_code = $_POST['company_code'];
        

          // open connection to db
          $mysqli = OpenCon();

          $insert = $mysqli->query("INSERT INTO accountsxcompany ( id, company_code )
          VALUES('$id', '$company_code')");

          
        if (!$insert) {
            // if there is an error on the insert
            echo $mysqli->error;
        }


        //mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
        
		$_SESSION['message'] = "Accounts X Company Info saved!"; 
		header('location: crud_accountsxcompany.php');
	}

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $company_code = $_POST['company_code'];

        // open connection to db
        $mysqli = OpenCon();

        $update = $mysqli->query("UPDATE accountsxcompany SET id='$id' WHERE id='$id' AND company_code='$company_code'");

        if (!$update) {
            // if there is an error on the update
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Accounts X Company Updated!"; 
		header('location: crud_accountsxcompany.php');
    }

    if (isset($_GET['del'])) {
        $company_code = $_GET['del'];
        
         // open connection to db
         $mysqli = OpenCon();
           
         $delete = $mysqli->query("DELETE FROM accountsxcompany WHERE id='$id' AND company_code='$company_code'");

        if (!$delete) {
            // if there is an error on the delete
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Accounts X Company deleted!"; 
		header('location: crud_accountsxcompany.php');
    }


    ?>

