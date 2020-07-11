<?php 
	session_start();
//	$db = mysqli_connect('localhost', 'root', '', 'crud');

    include_once 'db_connection.php';

	// initialize variables
	$company_code = "";
    $company_name = "";
    $address = "";
    $address2 = "";
    $city = "";
    $state = "";
    $zipcode = "";
    $logo = "";
    
    //$id = 0;
    
	$update = false;

	if (isset($_POST['save'])) {
		$company_code = $_POST['company_code'];
        $company_name = $_POST['company_name'];
        $address = $_POST['address'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        $logo = $_POST['logo'];

          // open connection to db
          $mysqli = OpenCon();

          $insert = $mysqli->query("INSERT INTO company (company_code, company_name, address, address2, city, state, zipcode, logo )
          VALUES('$company_code','$company_name','$address','$address2','$city','$state','$zipcode', '$logo')");

          
        if (!$insert) {
            // if there is an error on the insert
            echo $mysqli->error;
        }
        



        //mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
        
		$_SESSION['message'] = "Company Info saved!"; 
		header('location: crud_company.php');
	}

    if (isset($_POST['update'])) {
        $company_code = $_POST['company_code'];
        $company_name = $_POST['company_name'];
        $address = $_POST['address'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        $logo = $_POST['logo'];

        // open connection to db
        $mysqli = OpenCon();

        $update = $mysqli->query("UPDATE company SET company_name='$company_name', address='$address', address2='$address2', city='$city', state='$state', zipcode='$zipcode', logo='$logo' WHERE company_code='$company_code'");

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

