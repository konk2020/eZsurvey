
<!DOCTYPE html>
<html>
<head>
    <title>Survey Answers</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--For icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php  include('header.php'); ?>
<?php  include('menu.php'); ?>
<h2 class="crud_title"><b><i>Export Answers</i></b></h2><br>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Survey Answers
            <a href="export_data.php" class="btn btn-primary pull-right" style="width:20%;">Export Answers</a>
        </div>

        <form method="POST" action="">
        <input type="SUBMIT"  class="submit form-control btn btn-primary" name="allrecs" value="Show All" required style="width: 50%;"/>
        </form>

        <form method="POST" action="">
        <input type="SUBMIT"  class="submit form-control btn btn-primary" name="passfail" value="Only Pass/Fail" required style="width: 50%;"/>
        </form>


        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                      <th>Name</th>
                      <th>State</th>
                      <th>Q_No</th>
                      <th>Question</th>
                      <th>Answer</th>
                      <th>Message_id</th>
                      <th>Message</th>
                      <th>Company Code</th>
                      <th>Survey Taken</th>

                      

                      
                    </tr>
                </thead>
                <tbody>
                <?php
                    //include database configuration file
                    include 'db_connection.php';

                    $db = OpenCon();
                    
                    //get records from database
                    if (isset($_POST['allrecs'])) {
                        // user press show all then no WHERE clause, hence show all records
                    $query = $db->query("select name, answers.state, answers.question_id, question, answer, answers.message_id, message, company_id, surveytaken from answers inner join questions on answers.state=questions.state and
                    answers.question_id=questions.question_id LEFT JOIN messages on answers.message_id=messages.message_id and answers.state=messages.state order by name,surveytaken");
                    }
                    
                    else if (isset($_POST['passfail'])) {
                         // only show records with pass or fail (PS or FL)
                         $query = $db->query("select name, answers.state, answers.question_id, question, answer, answers.message_id, message, company_id, surveytaken from answers inner join questions on answers.state=questions.state and
                         answers.question_id=questions.question_id LEFT JOIN messages on answers.message_id=messages.message_id and answers.state=messages.state WHERE answers.message_id = 'PS' OR answers.message_id ='FL' order by name,surveytaken");
                    }
                    else {
                        // none of the button were press show teh default (pass or fail)
                        $query = $db->query("select name, answers.state, answers.question_id, question, answer, answers.message_id, message, company_id, surveytaken from answers inner join questions on answers.state=questions.state and
                        answers.question_id=questions.question_id LEFT JOIN messages on answers.message_id=messages.message_id and answers.state=messages.state WHERE answers.message_id = 'PS' OR answers.message_id ='FL' order by name,surveytaken");

                    }
                   
                   
                    if($query->num_rows > 0){ 
                        while($row = $query->fetch_assoc()){ ?>                
                    <tr>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['state']; ?></td>
                      <td><?php echo $row['question_id']; ?></td>
                      <td><?php echo $row['question']; ?></td> 
                      <td><?php echo $row['answer']; ?></td> 
                      <td><?php if ($row['message_id'] == "PS") 
                        {echo "<i class='fa fa-thumbs-up' style='color: green;'></i>";} 
                        else if ($row['message_id'] == "FL") {echo "<i class='fa fa-thumbs-down' style='color: red;'></i>";}
                          else { echo $row['message_id']; }?></td>
                      <td><?php echo $row['message']; ?></td>
                      <td><?php echo $row['company_id']; ?></td>
                      <td><?php echo $row['surveytaken']; ?></td>

                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="9">No answers found.....</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<?php  include('footer.php'); ?>