<?php
//include database configuration file
include 'db_connection.php';

$db = OpenCon();

//get records from database
$query = $db->query("select name, answers.state, answers.question_id, question, answer, answers.message_id, message, company_id, surveytaken from answers inner join questions on answers.state=questions.state and
answers.question_id=questions.question_id LEFT JOIN messages on answers.message_id=messages.message_id and answers.state=messages.state");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "ezsurvey_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('Name', 'State', 'Q_No', 'Question', 'Answer', 'Message ID', 'Message', 'Company_id', 'Survey Taken');  
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
      //  $status = ($row['status'] == '1')?'Active':'Inactive';
        $lineData = array($row['name'], $row['state'], $row['question_id'], $row['question'], $row['answer'], $row['message_id'], $row['message'], $row['company_id'], $row['surveytaken']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>