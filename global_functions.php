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

function what_is_the_state($company_code) {
    //return the state based on the company_code typed by the user
    $conn = OpenCon();
    $sql = "SELECT state FROM company WHERE company_code='$company_code'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();

    return $row['state']; 
                 
    CloseCon($conn);       
}

function get_company_code($user_id) {
    //return the company code based on the user passed. If user is not yet assigned to a code then return null.
    $conn = OpenCon();
    $sql = "SELECT company_code FROM accountsxcompany WHERE id='$user_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();

    if ($result->num_rows > 0) {
        return $row['company_code'];  
    }   else {
        //  user name has not yet been assigned to a company code  in table accountsxcompany
        return null;
    } 
                 
    CloseCon($conn);       
}

function get_username_id($username) {
    //return the id based on the user passed 
    $conn = OpenCon();
    $sql = "SELECT id FROM accounts WHERE username='$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();

    return $row['id']; 
                 
    CloseCon($conn);       
}

function get_username_name($username) {
    //return the name based on the user passed 
    $conn = OpenCon();
    $sql = "SELECT name FROM accounts WHERE username='$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();

    return $row['name']; 
                 
    CloseCon($conn);       
}

function update_company_logo($logo_path, $company_code) {
    //return the company code based o the user passed 
    $conn = OpenCon();
    $sql = "UPDATE company set logo = '$logo_path' WHERE company_code='$company_code'";
    $conn->query($sql); 
    
    return 1; // 1=success
                 
    CloseCon($conn);       
}

function save_answers($state, $q_id, $ans, $m_id, $uname, $company_code) {
    //return the state based on the company_code typed by the user
    $conn = OpenCon();

    $trans_date = null; // tables field is set to datetime, this will auto type stamp when you send a null value

   // $sql = "INSERT INTO answers (state, question_id, answer, timestamp, message_id, name, company_code)
   // VALUES('$state','$q_id','$ans','$trans_date','$m_id','$uname','$company_code')";
    //$date_time = date("m/d/Y h:m:s");

    console_log("parameters---->".$state." ".$q_id." ".$ans." ".$m_id." ".$uname." ".$company_code);
    $sql = "INSERT INTO answers (state, question_id, answer, message_id, name, company_id)
    VALUES('$state', '$q_id', '$ans','$m_id', '$uname', '$company_code')";
   
    $conn->query($sql); 
 

    return 1; // 1=success
                 
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
