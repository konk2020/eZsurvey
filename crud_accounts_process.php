<?php 
	session_start();
    include_once "global_functions.php";

	// initialize variables
	$username = "";
    $email = "";
    $verified = "";
   // $createdate = "";
    $name = "";
    $phone = "";
    $role = "";
    
    //$id = 0;
    
	$update = false;


	if (isset($_POST['save'])) {
		$username = $_POST['username'];
        $email = $_POST['email'];
        $verified = $_POST['verified'];
      //  $createdate = $_POST['createdate'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];

          // open connection to db
          $mysqli = OpenCon();

          $insert = $mysqli->query("INSERT INTO accounts (username, email, verified, name, phone, role )
          VALUES('$username','$email','$verified','$name','$phone', '$role')");

          
        if (!$insert) {
            // if there is an error on the insert
            echo $mysqli->error;
        }

        //mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
        
		$_SESSION['message'] = "Account Info saved!"; 
		header('location: crud_accounts.php');
	}
  

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
     //   $username = $_POST['username'];
        $email = $_POST['email'];
        $verified = $_POST['verified'];
       // $createdate = $_POST['createdate'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];

        // open connection to db
        $mysqli = OpenCon();
       
        $update = $mysqli->query("UPDATE accounts SET email='$email', verified='$verified', name='$name', phone='$phone', role='$role' WHERE id='$id'");

        if (!$update) {
            // if there is an error on the update
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Account Updated!"; 
		header('location: crud_accounts.php');
    }



    if (isset($_GET['del'])) {
        $username = $_GET['del'];
        
         // open connection to db
         $mysqli = OpenCon();

         $delete = $mysqli->query("DELETE FROM accounts WHERE username='$username'");

        if (!$delete) {
            // if there is an error on the delete
            echo $mysqli->error;
        }

        $_SESSION['message'] = "Company deleted!"; 
		header('location: crud_accounts.php');
    }


    ?>

