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
<p>An e-mail will be sent to you with instructions on how to reset your password.<p>
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
?>
</td>
</tr>



</form>
<?php include 'footer.php'; ?>


<?php
if (isset($_GET["reset"])) {
    if ($_GET["reset"]== "success") {
        echo '<p class="signupsuccess">Check your e-mail</p>';
        
    }

}
?>

</div>



</body>
</html>