<?php  include('survey_header.php'); ?>
<?php  include('crud_messages_process.php'); ?>



<?php 
	if (isset($_GET['edit'])) {
		$company_code = $_GET['edit'];
        $update = true;
        
        $conn = OpenCon();
        $sql = "SELECT * from messages where company_code='$company_code'";    
        $result = $conn->query($sql);
        //$record = $result->num_rows;

		if ($result->num_rows == 1 ) {
			$n = $result->fetch_array();
			$state = $n['state'];
            $message_id = $n['message_id'];
            $regulated = $n['regulated'];
            $message = $n['message'];
            $company_code = $n['company_code'];
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Message Information</title>
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
        $sql = "SELECT * from messages";    
        $result = $conn->query($sql);
       
?>

<table>
	<thead>
   
 		<tr>
			<th>State</th>
            <th>Message ID</th>
            <th>Regulated</th>
            <th>Message</th>
            <th>Company Code</th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
			<td><?php echo $row['state']; ?></td>
            <td><?php echo $row['message_id']; ?></td>
            <td><?php echo $row['regulated']; ?></td>
            <td><?php echo $row['message']; ?></td>
            <td><?php echo $row['company_code']; ?></td>

			<td>
				<a href="crud_messages.php?edit=<?php echo $row['company_code']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="crud_messages_process.php?del=<?php echo $row['company_code']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>



	<form method="post" action="crud_messages_process.php">
		<div class="input-group">
			<label>State</label>
            <input type="text" name="state" value="<?php echo $state; ?>">
           
		</div>
		<div class="input-group">
			<label>Message ID</label>
			<input type="text" name="message_id" value="<?php echo $message_id; ?>">
		</div>
        <div class="input-group">
			<label>Regulated</label>
			<input type="text" name="regulated" value="<?php echo $regulated; ?>">
		</div>
        <div class="input-group">
			<label>Message</label>
			<input type="text" name="message" value="<?php echo $message; ?>">
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