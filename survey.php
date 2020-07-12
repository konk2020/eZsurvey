<?php

// Author: Richard A. Negron
// Date: June 7, 2020
// Purpose: Survey
// File: survey.php
// Other files called: 
// includes: survey_header.php, footer.php

session_start();
//ini_set('display_errors', 1);



//require_once 'db_connection.php';
require_once 'global_functions.php';


console_log("Session var STATE: ".$_SESSION['state']);
console_log("Session var Q_ID: ".$_SESSION['q_id']);
console_log("Q_ID: ".$_POST['question_id']);

?>

<!DOCTYPE html>
<html>
<head>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include 'survey_header.php'; ?>
<form method="post" action="">
<table>

<?php


    // Get state and answer passed
    $company_code = $_POST['company_code'];
    $q_option = $_POST['q_option']; // what the user answerd 
    $u_name = $_POST['uname']; // user name (person taking the survey)
    
    console_log( $u_name);

    $next_q = what_is_the_next_question($_SESSION['q_id'], $_SESSION['state'], $q_option);
   
    echo "ANS ".$q_option." NXT Q ".$next_q;

    // we check if numeric to see if it has a message code M1, M2, or anything with a letter. 
    if (!is_numeric($next_q)){
        $_SESSION['m_id'] = $next_q;
    } else {
        $_SESSION['m_id'] = null;
    }

    // save answer
    if (isset($company_code) && isset($q_option)) {
        $rtn =  save_answers($_SESSION['state'], $_SESSION['q_id'], $q_option, $_SESSION['m_id'], $_SESSION['uname'], $company_code);
   //     $rtn =  save_answers('state', '102', 'q_option', 'm_id', 'uname', '$company_code');

        
        console_log('inserting...'.$rtn);
    }


    if (!isset($company_code)) { 
        // state is not set, and user has not answered any question, so ask the user
        echo '<tr>';
        echo '<td align="right">Enter Company Code:</td>';
        echo '<td><input type="TEXT" name="company_code" placeholder="Ex: ABC" required/></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right">Enter Your Name:</td>';  
        echo '<td><input type="TEXT" name="uname" placeholder="Ex: James Smith" required/></td>';
        
        // send question #1
        echo '<input type="hidden" name="question_id" value="1">'; 
        echo '</tr>';
     } else {
            //State passed... query the DB for first question

            $q_id = $_POST['question_id'];
            if ($q_id == '1') {
                // set the state as global so it can be used in SQL below
                $_SESSION['state'] = what_is_the_state($company_code);
                $_SESSION['company_code'] = $company_code;
                $_SESSION['q_id'] = 1;
                $_SESSION['uname'] = $u_name;
            } else {
                console_log("adding 1 to the Q");
                $_SESSION['q_id'] += 1;
            }

            // get first question
            $conn = OpenCon();
            //$sql = "SELECT question FROM questions WHERE question_id='$q_id' AND state='$glb_state'";
            $sql = "SELECT question FROM questions WHERE question_id='{$_SESSION['q_id']}' AND state='{$_SESSION['state']}'";
    
            $result = $conn->query($sql);
            $row = $result->fetch_array();
            $question = $row['question'];  
        
            if($result->num_rows == 0){
                unset($_SESSION['company_code']); // reset and ask again for the company code
                echo '<tr>';
                echo '<td colspan="2" style = "text-align:center; text-clor:red;">No questions available for this state</td>';
                echo '</tr>';
                //header("Location: survey.php?question=noquestionfound");
                //exit(); 
            } else {
            // display the question to the user
            echo '<tr>';
            echo '<td colspan="2" style = "text-align:center;">'.$question.'</td>';   
            echo '</tr>';

            echo '<tr>';
            //echo '<td colspan="2" style = "text-align:center;">';  
            ?>
        
            <td colspan="2" style = "text-align:center;"><input type="radio" name="q_option" value="no">  No <br> <br>
            <input type="radio" name="q_option" value="yes">  Yes</td>

            <?php
            echo '<input type="hidden" name="company_code" value='.$_SESSION['company_code'].'>'; 
            echo '</tr>';
            }

     } //else
   

?>

<tr>
    <td colspan="2" style = "text-align:center;"><input type="SUBMIT"  class="btn" name="submit" value="Next" required/></td>
</tr>

</form>


<?php include 'footer.php'; ?>


</body>
</html>
