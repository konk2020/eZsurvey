<?php  include('survey_header.php'); ?>
<?php  include('db_connection.php'); ?>


<!DOCTYPE html>
<html>
<head>
    <title>Survey Answers</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body>
<body>
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>

<?php  include('menu.php'); ?>


<?php 

        $conn = OpenCon();
        $sql = "select name, answers.state, answers.question_id, question, answer, answers.message_id, message, company_id from answers inner join questions on answers.state=questions.state and
		answers.question_id=questions.question_id LEFT JOIN messages on answers.message_id=messages.message_id and answers.state=messages.state";    
        $result = $conn->query($sql);
       
?>

<table>
	<thead>
        <tr>

		<td><form method="post" action="export.php">  
                 <input type="submit" name="export" value="CSV Export" class="edit_btn" />  
			 </form>  
			</td>
		</tr>
 		<tr>
			<th>Name</th>
            <th>State</th>
            <th>Q_no</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Message Id</th>
			<th>Message</th>
			<th>Company Code</th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['question_id']; ?></td>
            <td><?php echo $row['question']; ?></td>
            <td><?php echo $row['answer']; ?></td>
            <td><?php echo $row['message_id']; ?></td>
			<td><?php echo $row['message']; ?></td>
			<td><?php echo $row['company_id']; ?></td>
			
		</tr>
	<?php } ?>
</table>

	
</body>
</html>
<?php  include('footer.php'); ?>