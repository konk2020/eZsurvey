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


function what_is_the_next_question($q_id, $state, $ans) {
    //returns next question id or message id
    $conn = OpenCon();
    $sql = "SELECT question_id, goto_if_yes, goto_if_no FROM questions WHERE question_id='$q_id' AND state='$state'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();

    if ($ans=='yes'){
        return $row['goto_if_yes']; 
    } elseif ($ans=='no') {
        return $row['goto_if_no']; 
    } else {return 00;}
                 
    CloseCon($conn);       
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
