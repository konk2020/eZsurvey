<?php
// Author: Richard A. Negron
// Date: June 4, 2020
// Purpose: Admin page which provides the user option of what they can do 
// File: adminpage.php
// Other files called: login.php
// includes: header.php, footer.php

include_once 'global_functions.php';

session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: login.php");
    
    die();
}
console_log($_SESSION['userLogin']);
?>
<html>
<head>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<?php include 'header.php'; ?>


    <div class="container">    
       
       <h3 class="crud_title"><b><i> Admin Options</b></i></h3> <br></td>  
    <div style="text-align: center; margin-bottom: 1%;"><a href = "logo_upload_form.php" class="btn btn-primary">Upload your logo</a></div>          
        <div style="text-align: center; margin-bottom: 1%;"><a href = "crud_questions.php" class="btn btn-primary">Update survey questions</a></div>      
        <div style="text-align: center; margin-bottom: 1%;"><a href = "reset-password.php" class="btn btn-primary">Reset your password</a></div>       
        <div style="text-align: center; margin-bottom: 1%;"><a href = "export_answers.php" class="btn btn-primary">Download your survey results</a></div>
        <div style="text-align: center;"><a href = "crud_accounts.php" class="btn btn-primary">Update user information</a></div>  


    </div>

    <?php include 'footer.php'; ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>