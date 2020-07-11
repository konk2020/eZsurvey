<?php
// Author: Richard A. Negron
// Date: June 4, 2020
// Purpose: Login, Reset-Pwd, allow user to Register 
// File: login.php
// Other files called: adminpage.php, reset-password.php, registration.php
// includes: header.php, footer.php, db_connection.php

include 'db_connection.php';

$error = NULL;
ini_set('display_errors', 1);
session_start();

if (isset($_POST['submit'])){
    // Connect to the database 
  
        $mysqli = OpenCon();
  
    // Get form data
    $u = $mysqli->real_escape_string($_POST['u']);
    $p = $mysqli->real_escape_string($_POST['p']);
    $p = md5($p);

    // Query the database
    $resultSet = $mysqli->query("SELECT * FROM accounts WHERE username = '$u' AND password = '$p' LIMIT 1");

    if ($resultSet->num_rows !== 0 ){
        // Process Login
        $row = $resultSet->fetch_assoc();
        $user_id = $row['id'];
        $verified = $row['verified'];
        $email = $row ['email'];
        $date = $row['createdate'];
        $date = strtotime ($date);
        $date = date('M d Y', $date);

        if ($verified ==  1){
            // Continue processing

            //echo "Your account has been verified and you have been loged in";
            $_SESSION['userLogin'] = $user_id;
            header("Location: adminpage.php");
           // exit();
        } else {

            $error = "The account has not yet been verified. An email was send to $email on $date";
        }

    } else {
        // Invalid Credentials
        $error = "The username or password you entered is incorrect";

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
<td colspan="2" style = "text-align:center; color:red;">
<?php
if (isset($_GET["newpwd"])) {
    if ($_GET["newpwd"]== "passwordupdated") {
        echo '<p class="signupsuccess">Your password has been reset!</p>';
        
    }
}
?>
</td>
</tr>

<tr>
    <td align="right">Username:</td>
    <td><input type="TEXT" name="u" required/></td>
</tr>
<tr>
    <td align="right">Password:</td>
    <td><input type="PASSWORD" name="p" required/></td>
</tr>

<tr>
    <td colspan="2" style = "text-align:center;"><input type="SUBMIT"  class="submit" name="submit" value="Login" required/></form></td>
    <td colspan="2" style = "text-align:center;">
        </tr>

</tr>

<tr>
    <td colspan="2" style = "text-align:center; color:red;">
    
        <?php echo $error; ?>
       
  </td>
</tr>

<tr>
<td colspan="2" style = "text-align:center;">
<a href='reset-password.php'>Forgot your password?</a> <a href='registration.php'>Register</a>
</td>
</tr>

<?php include 'footer.php'; ?>

</div>
</body>
</html>