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
            <td colspan="1" style = "text-align:center;"> Upload your logo</td> 
        </tr>
        <tr>
            <td colspan="1" style = "text-align:center;"> Update survey questions</td> 
        </tr>
        <tr>
            <td colspan="1" style = "text-align:center;"> Reset your password</td> 
        </tr>
        <tr>
            <td colspan="1" style = "text-align:center;" class="click"> 
            <a href = "answers_export.php">Download your survey results</a>         
            </td> 
        </tr>

    </div>

    <?php include 'footer.php'; ?>
</body>
</html>