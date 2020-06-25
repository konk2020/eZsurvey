<?php 
	session_start();
//	$db = mysqli_connect('localhost', 'root', '', 'crud');

    include_once 'db_connection.php';

	// initialize variables
	$username = "";
    $email = "";
    $verified = "";
    $createdate = "";
    $name = "";
    $phone = "";
    $role = "";
    
    //$id = 0;
    
	$update = false;

	if (isset($_POST['save'])) {
		$username = $_POST['username'];
        $email = $_POST['email'];
        $verified = $_POST['verified'];
        $createdate = $_POST['createdate'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];

          // open connection to db
          $mysqli = OpenCon();

          $insert = $mysqli->query("INSERT INTO accounts (username, email, verified, createdate, name, phone, role )
          VALUES('$company_code','$username','$email','$verified','$createdate','$name','$phone', '$role')");

          
        if (!$insert) {
            // if there is an error on the insert
            echo $mysqli->error;
        }

        //mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
        
		$_SESSION['message'] = "Account Info saved!"; 
		header('location: crud_accounts.php');
	}

    if (isset($_POST['update'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $verified = $_POST['verified'];
        $createdate = $_POST['createdate'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];

        // open connection to db
        $mysqli = OpenCon();

        $update = $mysqli->query("UPDATE accounts SET username='$company_name', address='$address', address2='$address2', city='$city', state='$state', zipcode='$zipcode', logo='$logo' WHERE company_code='$company_code'");

        if (!$update) {
            // if there is an error on the update
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Company Updated!"; 
		header('location: crud_company.php');
    }



    if (isset($_GET['del'])) {
        $company_code = $_GET['del'];
        
         // open connection to db
         $mysqli = OpenCon();

         $delete = $mysqli->query("DELETE FROM company WHERE company_code='$company_code'");

        if (!$delete) {
            // if there is an error on the delete
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Company deleted!"; 
		header('location: crud_company.php');
    }


    ?>

