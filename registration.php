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
</head>

<body>
<?php include 'header.php'; ?>
<div class="container">    
<form method="POST" action="">
<table border="0" align="center" cellpadding="5">

<tr>
<td colspan="2" style = "text-align:center;"> 
    Create your Admin account for eZSurvey <br> <br> <a href="login.php"> Already have an account?</a>
    <br> <br>
</td>
   
</tr>

<tr>
    <td align="right">Username:</td>
    <td><input type="TEXT" name="u" placeholder="2 char minimum..." required/></td>
</tr>
<tr>
    <td align="right">Password:</td>
    <td><input type="PASSWORD" name="p" placeholder="5 char minimum..." required/></td>
</tr>
<tr>
    <td align="right">Repeat Password:</td>
    <td><input type="PASSWORD" name="p2" placeholder="repeat password..." required/></td>
</tr>
<tr>
    <td align="right">Email Address:</td>
    <td><input type="EMAIL" name="e" placeholder="name@mydomanin.com..." required/></td>
</tr>
<tr>
<td colspan="2" style = "text-align:center; color:red;">
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

</td>
</tr>

<tr>
    <td colspan="2" style = "text-align:center;"><input type="SUBMIT"  class="submit" name="submit" value="Register" required/></td>
</tr>

<?php include 'footer.php'; ?>

</form>
</div>


</center>

</body>
</html>
