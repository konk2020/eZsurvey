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

<html>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include 'survey_header.php'; ?>
<div class="container">    
<form method="POST" action="">
<table border="0" align="center" cellpadding="5">

<?php
//if (isset($_POST['submit'])){

    // Get state passed
    $state = $_POST['state'];
    $q_option = $_POST['q_option'];
    echo $q_option;
    

    if (!isset($state)) { 
        // state is not set, and user has not answered any question, so ask the user
        echo '<tr>';
        echo '<td align="right">Enter State:</td>';
        echo '<td><input type="TEXT" name="state" placeholder="Ex: VA" required/></td>';
        // send question #1
        echo '<input type="hidden" name="question_id" value="1">'; 
        echo '</tr>';
     } else {
            //State passed... query the DB for first question

            $q_id = $_POST['question_id'];
            if ($q_id == '1') {
                // set the state as global so it can be used in SQL below
                $_SESSION['state'] = $state;
                $_SESSION['q_id'] = 1;
            }

            // get first question
            $conn = OpenCon();
            //$sql = "SELECT question FROM questions WHERE question_id='$q_id' AND state='$glb_state'";
            $sql = "SELECT question FROM questions WHERE question_id='{$_SESSION['q_id']}' AND state='{$_SESSION['state']}'";
    
            $result = $conn->query($sql);
            $row = $result->fetch_array();
            $question = $row['question'];  
        
            if($result->num_rows == 0){
                unset($_SESSION['state']); // reset and ask again for the state
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
            echo '<input type="hidden" name="state" value='.$_SESSION['state'].'>'; 
            echo '</tr>';
            }

     } //else
   // }

?>

<tr>
    <td colspan="2" style = "text-align:center;"><input type="SUBMIT"  class="submit" name="submit" value="Next" required/></td>
</tr>

</form>
</div>

<?php include 'footer.php'; ?>


</body>
</html>
