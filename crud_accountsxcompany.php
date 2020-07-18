<?php  include('survey_header.php'); ?>
<?php  include('crud_accountsxcompany_process.php'); 
?>



<?php 
	if (isset($_GET['edit'])) {
		$rec_id = $_GET['edit'];
        $update = true;
        
        $conn = OpenCon();
        $sql = "SELECT * from accountsxcompany INNER JOIN accounts ON accountsxcompany.id = accounts.id  where rec_id='$rec_id'";    
        $result = $conn->query($sql);
        //$record = $result->num_rows;

		if ($result->num_rows == 1 ) {
			$n = $result->fetch_array();
            $id = $n['id'];
			$company_code = $n['company_code'];
            $username = $n['username'];
            $name = $n['name'];
            $rec_id = $n['rec_id'];
		}
	}
//QUERY FOR ID DROPDOWN
        $conn = OpenCon();
        $sql = "SELECT id from accountsxcompany";    
        $resultSet = $conn->query($sql);
//QUERY FOR USERNAME DROPDOWN
        $conn = OpenCon();
        $sql = "SELECT username, name from accounts";    
        $resultSetUser = $conn->query($sql);
// query all the company codes
        $conn = OpenCon();
        $sql = "SELECT company_code, company_name from company";     
        $resultSetComp = $conn->query($sql);


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
        $sql = "SELECT * from accountsxcompany INNER JOIN accounts ON accountsxcompany.id = accounts.id";    
        $result = $conn->query($sql);
?>
<h2 class="crud_title"><b><i>Company X User</i></b></h2>
<table class="tiny table table-striped">
	<thead class="thead-dark">
   
 		<tr>
            <th>Company Code</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th></th>
            <th></th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
            <td><?php echo $row['company_code']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
			<td>
				<a href="crud_accountsxcompany.php?edit=<?php echo $row['rec_id']; ?>" class="edit_btn btn btn-success" >Edit</a>
			</td>
			<td>
				<a href="crud_accountsxcompany_process.php?del=<?php echo $row['rec_id']; ?>" class="del_btn btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>



	<form method="post" action="crud_accountsxcompany_process.php">

        <!--DROPDOWN FOR USERNAME-->
        <fieldset class="form-group">
			<label class="form-lbl">Username</label>
            <?php if (isset($_GET['edit'])): ?>
            <select name="username" disabled class="form-control">
            <?php else: ?>
            <select name="username" class="form-control">
            <?php endif ?>
            <?php
            if (isset($_GET['edit'])) {echo "<option value='$username' selected >".$username." - ".$name."</option>";}
            else { echo "<option selected>--Select--</option>";}
            while($rows = $resultSetUser->fetch_assoc()) {
            $usernameDisplay = $rows["username"] . " - " . $rows["name"];
            $username = $rows["username"];
            echo "<option value='$username'>$usernameDisplay</option>";
            }    
            ?>
            </select>
        </fieldset>
        <!--DROPDOWN FOR COMPANY CODE FIELD-->
        <fieldset class="form-group">
			<label class="form-lbl">Company Code</label>
            <select name="company_code" class="form-control">
		<?php 
			if (isset($_GET['edit'])) {echo "<option value='$company_code' selected >".$company_code."</option>";}
            else {echo "<option selected>--Select--</option>";}
            while($rows = $resultSetComp->fetch_assoc()) {
			$company_codeDisplay = $rows["company_code"] . " - " . $rows['company_name'];
			$company_code = $rows["company_code"];
			echo "<option value='$company_code'>$company_codeDisplay</option>";
		}   
        ?>
        </select>
		</fieldset>
		<div class="input-group">

        <?php if ($update == true): ?>
            <button class="btn btn-success" type="submit" name="update"><b>Update</b></button>
        <?php else: ?>
            <button class="btn btn-success" type="submit" name="save" ><b>Save</b></button>
        <?php endif ?>

		</div>
	</form>
</body>
</html>
<?php  include('footer.php'); ?>