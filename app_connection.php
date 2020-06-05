<?php
// Author: Richard A. Negron
// Date: June 4, 2020
// Purpose: Function to return the URL for local host or the prod website by reading the protocol 
// File: app_connection.php
// Other files called: none
// includes: note

function app_url()
 {
 
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    if ($protocol=='https://') {
        $protocol_var = 'https://';
    } else {
        $protocol_var = 'http://';
    }
    
    $host_var = 'localhost';
    
    if (strpos($url, $protocol_var) !== false and strpos($url, $host_var) !== false) {
      // verify.php is used for the email being send to the user
      $secure_url = 'http://localhost:8888/eZsurvey/';
    
    } else {
      
      $secure_url = 'https://jvrtechllc.com/ezsurvey/';
        
      }
 
 return $secure_url;
 }
 
?>