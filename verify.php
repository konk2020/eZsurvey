<?php

// Author: Richard A. Negron
// Date: June 4, 2020
// Purpose: Reset password for user 
// File: verify.php
// Other files called: login.php
// includes: db_connection.php

require_once 'db_connection.php';

if (isset($_GET['vkey'])){
    // Process Verification
    $vkey = $_GET['vkey'];

    // open DB connection
    $mysqli = OpenCon();
    
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
