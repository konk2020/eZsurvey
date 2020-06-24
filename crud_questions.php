<?php  include('survey_header.php'); ?>
<?php  include('crud_questions_process.php'); ?>



<?php 
	if (isset($_GET['edit'])) {
		$company_code = $_GET['edit'];
        $update = true;
        
        $conn = OpenCon();
        $sql = "SELECT * from questions where state='$state'";    
        $result = $conn->query($sql);
        //$record = $result->num_rows;

		if ($result->num_rows == 1 ) {
			$n = $result->fetch_array();
            $state = $n['state'];
            $question_id = $n['question_id'];
            $regulated = $n['regulated'];
            $question = $n['question'];
            $options = $n['options'];
            $goto_if_yes = $n['goto_if_yes'];
            $goto_if_no = $n['goto_if_no'];
            $company_code = $n['company_code'];
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Company Questions</title>
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
        $sql = "SELECT * from questions";    
        $result = $conn->query($sql);
       
?>

<table>
	<thead>
   
 		<tr>
			<th>State</th>
            <th>Question ID</th>
            <th>Regulated</th>
            <th>Question</th>
            <th>Options</th>
            <th>Go to if yes</th>
            <th>Go to if no</th>
			<th>Company Code</th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
			<td><?php echo $row['state']; ?></td>
            <td><?php echo $row['question_id']; ?></td>
            <td><?php echo $row['regulated']; ?></td>
            <td><?php echo $row['question']; ?></td>
            <td><?php echo $row['options']; ?></td>
            <td><?php echo $row['goto_if_yes']; ?></td>
            <td><?php echo $row['goto_if_no']; ?></td>
            <td><?php echo $row['company_code']; ?></td>

			<td>
				<a href="crud_questions.php?edit=<?php echo $row['company_code']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="crud_questions_process.php?del=<?php echo $row['company_code']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>



	<form method="post" action="crud_questions_process.php">
		<div class="input-group">
			<label>State</label>
            <input type="text" name="state" value="<?php echo $state; ?>">
           
		</div>
		<div class="input-group">
			<label>Question ID</label>
			<input type="text" name="question_id" value="<?php echo $question_id; ?>">
		</div>
        <div class="input-group">
			<label>Regulated</label>
			<input type="text" name="regulated" value="<?php echo $regulated; ?>">
		</div>
        <div class="input-group">
			<label>Question</label>
			<input type="text" name="question" value="<?php echo $question; ?>">
		</div>
        <div class="input-group">
			<label>Options</label>
			<input type="text" name="options" value="<?php echo $options; ?>">
		</div>
        <div class="input-group">
			<label>Go to if yes</label>
			<input type="text" name="goto_if_yes" value="<?php echo $goto_if_yes; ?>">
		</div>
        <div class="input-group">
			<label>Go to if no</label>
			<input type="text" name="goto_if_no" value="<?php echo $goto_if_no; ?>">
		</div>
        <div class="input-group">
			<label>Company Code</label>
			<input type="text" name="company_code" value="<?php echo $company_code; ?>">
		</div>
		<div class="input-group">

        <?php if ($update == true): ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button class="btn" type="submit" name="save" >Save</button>
        <?php endif ?>

		</div>
	</form>
</body>
</html>
<?php  include('footer.php'); ?>