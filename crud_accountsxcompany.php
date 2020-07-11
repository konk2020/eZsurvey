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

<table class="tiny">
	<thead>
   
 		<tr>
            <th>Company Code</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
            <td><?php echo $row['company_code']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
			<td>
				<a href="crud_accountsxcompany.php?edit=<?php echo $row['rec_id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="crud_accountsxcompany_process.php?del=<?php echo $row['rec_id']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>



	<form method="post" action="crud_accountsxcompany_process.php">

		<div class="input-group">
            <input type="text" name="id" value="<?php echo $id; ?>" hidden>
		</div>
        <!--DROPDOWN FOR USERNAME-->
        <div class="input-group">
			<label>Username</label>
            <?php if (isset($_GET['edit'])): ?>
            <select name="username" disabled>
            <?php else: ?>
            <select name="username">
            <?php endif ?>
            <?php
            echo "<option value='$username' selected >".$username." - ".$name."</option>";
            while($rows = $resultSetUser->fetch_assoc()) {
            $usernameDisplay = $rows["username"] . " - " . $rows["name"];
            $username = $rows["username"];
            echo "<option value='$username'>$usernameDisplay</option>";
            }    
            ?>
            </select>
        </div>
        <!--DROPDOWN FOR COMPANY CODE FIELD-->
        <div class="input-group">
			<label>Company Code</label>
            <select name="company_code">
			<option value="" selected disabled hidden>Choose here</option>
		<?php 
			echo "<option value='$company_code' selected >".$company_code."</option>";
            while($rows = $resultSetComp->fetch_assoc()) {
			$company_codeDisplay = $rows["company_code"] . " - " . $rows['company_name'];
			$company_code = $rows["company_code"];
			echo "<option value='$company_code'>$company_codeDisplay</option>";
		}   
        ?>
        </select>
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