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
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
</head>

<body>

<?php include 'header.php'; ?>
<div class="container">    
<form method="POST" action="">
<fieldset class="form-group">
    <input type="text" name="u" required class="form-control" placeholder="Username" style="width: 50%; margin: 0 auto;"/>
</fieldset>
<fieldset class="form-group" style="margin: 5px auto;">
<div class="input-group" style="width: 50%; margin: 0 auto;">
    <input type="password" name="p" required class="form-control" placeholder="Password" data-toggle="password"/>
<div class="input-group-append">
    <div class="input-group-text"><i class="fa fa-eye"></i></div>
</div>
</div>
</fieldset>
<fieldset class="form-group" style="text-align: center;">
<br><input type="SUBMIT"  class="submit form-control btn btn-primary" name="submit" value="Login" required style="width: 50%;"/>
     <fieldset ><a href='reset-password.php'>Forgot your password?</a> <a href='registration.php'>Register</a></fieldset>
</fieldset>
</form>

   
    
<?php
if (isset($_GET["newpwd"])) {
    if ($_GET["newpwd"]== "passwordupdated") {
        echo '<p class="signupsuccess" style = "text-align:center; color:red;">Your password has been reset!</p>';
        
    }
}
?>





<table>
<tr>
    <td colspan="2" style = "text-align:center; color:red;">
    
        <?php echo $error; ?>
       
  </td>
</tr>
</table>



<?php include 'footer.php'; ?>

</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>!function(a){a(function(){a('[data-toggle="password"]').each(function(){var b = a(this); var c = a(this).parent().find(".input-group-text"); c.css("cursor", "pointer").addClass("input-password-hide"); c.on("click", function(){if (c.hasClass("input-password-hide")){c.removeClass("input-password-hide").addClass("input-password-show"); c.find(".fa").removeClass("fa-eye").addClass("fa-eye-slash"); b.attr("type", "text")} else{c.removeClass("input-password-show").addClass("input-password-hide"); c.find(".fa").removeClass("fa-eye-slash").addClass("fa-eye"); b.attr("type", "password")}})})})}(window.jQuery);</script>
</body>
</html>