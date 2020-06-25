<?php
// Author: Richard A. Negron
// Date: June 4, 2020
// Purpose: Admin page which provides the user option of what they can do 
// File: adminpage.php
// Other files called: login.php
// includes: header.php, footer.php

session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: login.php");
    die();
}
?>
<html>
<head>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include 'header.php'; ?>


    <div class="container">    
        <table border="0" align="center" cellpadding="5">
       
        <tr>
            <td colspan="1" style = "text-align:center;">  <u><h3> Admin Options </h3></u></td> 
        </tr>
        <tr>
            <td colspan="1" style = "text-align:center;" class="click"> 
            <a href = "crud_company.php">Upload your logo</a>         
            </td> 

        </tr>
        <tr>
            <td colspan="1" style = "text-align:center;" class="click"> 
            <a href = "crud_questions.php">Update survey questions</a>         
            </td> 
        </tr>
        <tr>
            <td colspan="1" style = "text-align:center;" class="click"> 
            <a href = "reset-password.php">Reset your password</a>         
            </td> 
        </tr>
        <tr>
            <td colspan="1" style = "text-align:center;" class="click"> 
            <a href = "export_answers.php">Download your survey results</a>         
            </td> 
        </tr>

        <tr>
            <td colspan="1" style = "text-align:center;" class="click"> 
            <a href = "crud_accounts.php">Update user information</a>         
            </td> 
        </tr>


    </div>

    <?php include 'footer.php'; ?>
</body>
</html>