<?php

include 'db_connection.php';

//ini_set('display_errors', 1);


function console_log($output, $with_script_tags = true) {
   // used to write to the browser console
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}


function check_reshuffle() {
    // -- returns 1 when all the cards on the deck has been drawn (52 if them)
    $conn = OpenCon();
    
    if (isset($_POST["reset-request-submit"])) {

        // check to make sure the email sent over exists in the accouts table
        $conn = OpenCon();
        $userEmail = $_POST["email"];
    
        $sql = "SELECT * FROM accounts WHERE email='$userEmail' LIMIT 1";
        $result = $conn->query($sql);
    
        $row = $result->fetch_array();
                    
        $userID = $row['username'];  
    
        if($result->num_rows == 0){
            header("Location: ../reset-password.php?email=noemailfound");
            exit(); 
        }
    
//CloseCon($conn);       
}
}

//count the number of cards for a player 
function count_cards($player) {
    // -- checks the number of cards the player has in his hand
    // returns the number of cards
    $conn = OpenCon();
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT player from hand where player='$player'";
    
    if($result = $conn->query($sql)){
    
        if($result->num_rows > 0){  
            CloseCon($conn);
            return $result->num_rows;
        } else { CloseCon($conn); return '0'; }
    }    
    
          
}        

function did_game_start() {
// -- returns the number of cards delt, if its 7 the game started

    $conn = OpenCon();
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "SELECT count(draw) as draw_count from deck where draw='1'";
    
    if($result = $conn->query($sql)){
        if($result->num_rows > 0){
            while($row = $result->fetch_array()){
                
                     CloseCon($conn); 
                     return $row['draw_count'];
   
            }
        
        }
    }
    
          
}        
//-- used for baby pic
?>
