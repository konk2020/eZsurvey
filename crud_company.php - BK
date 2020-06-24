<?php  include('survey_header.php'); ?>
<?php  include('crud_company_process.php'); ?>



<?php 
	if (isset($_GET['edit'])) {
		$company_code = $_GET['edit'];
        $update = true;
        
        $conn = OpenCon();
        $sql = "SELECT * from company where company_code='$company_code'";    
        $result = $conn->query($sql);
        //$record = $result->num_rows;

		if ($result->num_rows == 1 ) {
			$n = $result->fetch_array();
			$compnay_code = $n['company_code'];
            $company_name = $n['company_name'];
            $address = $n['address'];
            $address2 = $n['address2'];
            $city = $n['city'];
            $state = $n['state'];
            $zipcode = $n['zipcode'];
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Company Information</title>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        $sql = "SELECT * from company";    
        $result = $conn->query($sql);
       
?>

<table>
	<thead>
   
 		<tr>
			<th>Company Code</th>
            <th>Company Name</th>
            <th>Address</th>
            <th>Address2</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
			<td><?php echo $row['company_code']; ?></td>
            <td><?php echo $row['company_name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['address2']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['zipcode']; ?></td>

			<td>
				<a href="crud_company.php?edit=<?php echo $row['company_code']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="crud_company_process.php?del=<?php echo $row['company_code']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>



	<form  method="post" action="crud_company_process.php">
		<div class="input-group" >
			<label>Company Code</label>
            <input type="text" name="company_code"  value="<?php echo $company_code; ?>">
           
		</div>
		<div class="input-group">
			<label>Company Name</label>
			<input type="text" name="company_name"  value="<?php echo $company_name; ?>">
		</div>
        <div class="input-group">
			<label>Address</label>
			<input type="text" name="address" value="<?php echo $address; ?>">
		</div>
        <div class="input-group">
			<label>Address 2</label>
			<input type="text" name="address2" value="<?php echo $address2; ?>">
		</div>
        <div class="input-group">
			<label>City</label>
			<input type="text" name="city" value="<?php echo $city; ?>">
		</div>
        <div class="input-group">
			<label>State</label>
			<input type="text" name="state" value="<?php echo $state; ?>">
		</div>
        <div class="input-group">
			<label>Zip Code</label>
			<input type="text" name="zipcode" value="<?php echo $zipcode; ?>">
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