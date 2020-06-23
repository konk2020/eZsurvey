 <?php  
     
     //export.php  
      include 'db_connection.php';

 if(isset($_POST["export"]))  


    $conn = OpenCon();
    //$sql = "SELECT question_id, goto_if_yes, goto_if_no FROM questions WHERE question_id='$q_id' AND state='$state'";
    
 {  
   
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Name', 'State', 'Q_No', 'Question', 'Answer', 'Message ID', 'Message', 'Company_id'));  
      $sql = "select name, answers.state, answers.question_id, question, answer, answers.message_id, message, company_id from answers inner join questions on answers.state=questions.state and
      answers.question_id=questions.question_id LEFT JOIN messages on answers.message_id=messages.message_id and answers.state=messages.state";  

      $result = $conn->query($sql);

      while($row = $result->fetch_array())  
      {  
           fputcsv($output, $row);  
      }  

      fclose($output);  
 }  
 ?>  