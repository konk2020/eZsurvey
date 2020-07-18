<?php
// Author: Richard A. Negron
// Date: June 4, 2020
// Purpose: Reset password for user 
// File: reset-password.php
// Other files called: reset-request.inc.php
// includes: header.php, footer.php
?>

<html>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<?php include 'header.php'; ?>
<div class="container">  
<!--<form method="POST" action="includes/reset-request.inc.php1">-->
<form method="POST" action="includes/reset-request.inc.php">
<fieldset class="form-group">
    <h3 class="crud_title">Reset your password</h3>
    <input type="TEXT" name="email" placeholder="Enter your email..." required class="form-control" style="width: 50%;"/>
</fieldset>
<fieldset style="text-align:center;">
<input type="SUBMIT"  class="submit btn btn-primary" name="reset-request-submit" value="Get new password by e-mail" style="margin: 0 auto;"/>
</fieldset>
</form>


<?php
if (isset($_GET["email"])) {
    if ($_GET["email"]== "noemailfound") {
        echo '<p class="pwdreset" style = "text-align:center; color:red;">You did not use this email to register</p>';
        
    }
}
if (isset($_GET["reset"])) {
    if ($_GET["reset"]== "success") {
        echo '<p class="signupsuccess"  style = "text-align:center; color:green;>Check your e-mail</p>';
        
    }
}    
?>
<?php include 'footer.php'; ?>
</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>