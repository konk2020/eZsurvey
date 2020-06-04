<?php
if (isset($_GET['vkey'])){
    // Process Verification
    $vkey = $_GET['vkey'];

  //  $mysqli = NEW MySQLi('localhost','root','root', 'eZsurvey');
    $mysqli = NEW MySQLi ('localhost','jvrtechl_ezsurveyadmin','mk74sps49', 'jvrtechl_ezsurvey');
    
    $resultSet = $mysqli->query("SELECT verified, vkey FROM accounts WHERE verified = 0 AND vkey = '$vkey'");

    if ($resultSet->num_rows == 1) {
        // Validate The mail
        $update = $mysqli->query("UPDATE accounts SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");

        if ($update){
            echo "<h2>Your account has been verified. <a href='login.php'>Click to login</a></h2>"; 

        } else {
            echo $mysqli->error;

        }
 
    } else {

        die ("verify.php: Something went wrong: Check your database connection credentials or token has already been used or expired");
    }

}

?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

</body>

</html>
