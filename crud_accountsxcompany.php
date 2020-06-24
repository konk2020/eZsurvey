<?php  include('survey_header.php'); ?>
<?php  include('crud_accountsxcompany_process.php'); 
?>



<?php 
	if (isset($_GET['edit'])) {
		$company_code = $_GET['edit'];
        $update = true;
        
        $conn = OpenCon();
        $sql = "SELECT * from accountsxcompany where company_code='$company_code'";    
        $result = $conn->query($sql);
        //$record = $result->num_rows;

		if ($result->num_rows == 1 ) {
			$n = $result->fetch_array();
            $id = $n['id'];
			$company_code = $n['company_code'];
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Accounts X Company Information</title>
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
ini_set('display_errors', 1);
        $conn = OpenCon();
        $sql = "SELECT * from accountsxcompany";    
        $result = $conn->query($sql);
?>

<table class="tiny">
	<thead>
   
 		<tr>
            <th>ID</th>
			<th>Company Code</th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['company_code']; ?></td>

			<td>
				<a href="crud_accountsxcompany.php?edit=<?php echo $row['company_code']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="crud_accountsxcompany_process.php?del=<?php echo $row['company_code']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>



	<form method="post" action="crud_accountsxcompany_process.php">
		<div class="input-group">
			<label>ID</label>
            <input type="text" name="id" value="<?php echo $id; ?>">
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