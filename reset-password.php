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
</head>

<body>
<?php include 'header.php'; ?>
<div class="container">  
<table border="0" align="center" cellpadding="5">

<tr>
    <td colspan="2" style = "text-align:center;">Reset your password</td>   
</tr>

<!--<form method="POST" action="includes/reset-request.inc.php1">-->
<form method="POST" action="includes/reset-request.inc.php">

<tr>
    <td colspan="2" style = "text-align:center;" ><input type="TEXT" name="email" placeholder="Enter your email..." required/></td>
</tr>

<tr>
<td colspan="2" style = "text-align:center; font:20px Aria;">
</td>     
</tr>

<tr>
    <td colspan="2" style = "text-align:center;"><input type="SUBMIT"  class="submit" name="reset-request-submit" value="Get new password by e-mail"/></td>
</tr>

<tr>
<td colspan="2" style = "text-align:center; color:red;">
<?php
if (isset($_GET["email"])) {
    if ($_GET["email"]== "noemailfound") {
        echo '<p class="pwdreset">You did not use this email to register</p>';
        
    }
}
if (isset($_GET["reset"])) {
    if ($_GET["reset"]== "success") {
        echo '<p class="signupsuccess">Check your e-mail</p>';
        
    }
}    
?>
</td>
</tr>
</form>
</table>
<?php include 'footer.php'; ?>
</div>
</body>
</html>