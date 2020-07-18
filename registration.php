<?php

// Author: Richard A. Negron
// Date: June 4, 2020
// Purpose: Register user 
// File: registration.php
// Other files called: verify.php
// includes: mail.php, header.php, footer.php


// un-comment to display PHP errors
     ini_set('display_errors', 1);
$error = NULL;

     //ini_set('display_errors', 1);

require_once "mail.php";
require_once 'db_connection.php';
require_once "app_connection.php";


  
  $secure_url = app_url().'verify.php';
    

if (isset($_POST['submit'])){

    // Get form data
    $u = $_POST['u'];
    $p = $_POST['p'];
    $p2 = $_POST['p2'];
    $e = $_POST['e'];

    if (strlen($u) < 2 ){

        $error = "<p>Your username must be at least 2 characters</p>";

    } elseif ($p2 !== $p){

        $error = "<p>Your passwords do not match</p>";

    } elseif (strlen($p) < 5 ) {
        
        $error = "<p>Your password must be 5 or more characters</p>";  

    } else {
        // Form is valid

            // open connection to db
            $mysqli = OpenCon();

        // Sanitize from data
        $u = $mysqli->real_escape_string($u);
        $p = $mysqli->real_escape_string($p);
        $p2 = $mysqli->real_escape_string($p2);
        $e = $mysqli->real_escape_string($e);
        

        // Generate Vkey

        $vkey = md5 (time().$u);

        //check to see if the username exists 

        $insert = $mysqli->query("SELECT * FROM accounts WHERE username = '$u'");
        $insert1 = $mysqli->query("SELECT * FROM accounts WHERE email = '$e'");
        
        if ($insert->num_rows > 0) {


                // username exists 
                //send an error to the user
                header("Location: registration.php?username=exists");
                
        } elseif ($insert1->num_rows > 0){

                // email exists 
                //send an error to the user
                header("Location: registration.php?email=exists");


        } else {

                 // is a new username
                // Inset account into the database
                $p=md5($p);
                $insert = $mysqli->query("INSERT INTO accounts(username, password, email, vkey)
                VALUES('$u','$p','$e','$vkey')");

                if ($insert){
                    // Send EMail
                    $to = $e;
                    $subject = "OverEZ Technologies Email Verification";
                    $message = "Thank you for registering to our simple COVID-19 survey tool. <br>";
                    $message .= "In order to validate your account please click on link below.<br>";
                    $message .= "<a href='".$secure_url."?vkey=$vkey'>Validate your email</a>";
                    sendMail($to, $subject, $message);
                    //echo ("Success!");

                }else {

                    echo $mysqli->error;
                }

        }

    }

}

?>


<html>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<?php include 'header.php'; ?>
    
<div class="container">  

<form method="POST" action="">
    <h3 class="crud_title"><b><i>Create your Admin account for eZsurvey</i></b></h3><div style="text-align: center;"><a href="login.php"> Already have an account?</a></div><br>
<fieldset class="form-group">
    <label class="form-lbl">Username</label>
    <input type="TEXT" name="u" placeholder="2 char minimum..." required class="form-control"/>
</fieldset>
<fieldset class="form-group">
    <label class="form-lbl">Password</label>
    <input type="TEXT" name="p" placeholder="5 char minimum..." required class="form-control"/>
</fieldset>
<fieldset class="form-group">
    <label class="form-lbl">Repeat Password</label>
    <input type="TEXT" name="p2" placeholder="Repeat Password" required class="form-control"/>
</fieldset>
<fieldset class="form-group">
    <label class="form-lbl">Email Address</label>
    <input type="TEXT" name="e" placeholder="name@mydomain.com" required class="form-control"/>
</fieldset>
<input type="SUBMIT"  class="submit btn btn-primary" name="submit" value="Register" required/>
    </form>
<?php
// tell the user the username is already in used
if (isset($_GET["username"])) {
    if ($_GET["username"]== "exists") {
        echo '<p class="signupsuccess">That username already exists</p>';
       // echo "<a href='login.php'>Login Page</a>";
        
    }
} elseif (!empty($error)) {
    echo $error;

} elseif (isset($_GET["email"])) {

    if ($_GET["email"]== "exists") {
        echo '<p class="signupsuccess">Email provided already tied to another account</p>';
       // echo "<a href='login.php'>Login Page</a>";
        
    } else {   
    // email
     echo '<p class="signupsuccess"> Success! We sent an email to: '. $_GET["email"] .' so you can validate your email.</p>';
    }
}
?>

<?php include 'footer.php'; ?>


</div>


</center>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
