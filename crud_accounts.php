<?php  include('survey_header.php'); ?>
<?php  include('crud_accounts_process.php'); ?>

<?php 
   // ini_set('display_errors', 1);
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
        $update = true;

        $conn = OpenCon();
        $sql = "SELECT * from accounts where id='$id'";    
        $result = $conn->query($sql);
        //$record = $result->num_rows;

		if ($result->num_rows == 1 ) {
			$n = $result->fetch_array();
			$username = $n['username'];
            $email= $n['email'];
            $verified = $n['verified'];
            $createdate = $n['createdate'];
            $name = $n['name'];
            $phone = $n['phone'];
            $role = $n['role'];
        }
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
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
        $sql = "SELECT * from accounts";    
        $result = $conn->query($sql);
       
?>

<table>
	<thead>
   
 		<tr>
			<th>Username</th>
            <th>Email</th>
            <th>Email Verified</th>
            <th>Create Date</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Role</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
			<td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php if($row['verified'] == 1) { echo "Yes";} else {echo "No";} ?></td>
            <td><?php echo date ("m/d/y", strtotime($row['createdate'])); ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['role']; ?></td>
          
		
			<td>
				<a href="crud_accounts.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="crud_accounts_process.php?del=<?php echo $row['id']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>



	<form method="post" action="crud_accounts_process.php">
		<div class="input-group">
			<label>Username</label>
            <?php if (isset($_GET['edit'])): ?>
            <input type="text" name="username" value="<?php echo $username; ?>" disabled>
            <?php else: ?>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <?php endif ?>
           
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
        <div class="input-group">
			<label>Email Verified</label>
			<select name="verified">
			<?php echo "<option value='$verified' selected >".($verified==1?'Yes':'No')."</option>"; ?>
            <option value="0">No</option>
            <option value="1">Yes</option>
            </select>
		</div>
        <div class="input-group">
			<label>Name </label>
			<input type="text" name="name" value="<?php echo $name; ?>">
		</div>
        <div class="input-group">
			<label>Phone</label>
			<input type="tel" name="phone" value="<?php echo $phone; ?>" placeholder="(000) 000-0000">
		</div>
        <div class="input-group">
			<label>Role</label>
            <select name="role">
			<?php echo "<option value='$role' selected >".$role."</option>";?>
            <option value="user">user</option>
            <option value="admin">admin</option>
            </select>
		</div>
    
		<div class="input-group">

		<?php if ($update == true): ?>
			<?php echo "<input type='hidden' name='id' value='$id'>" ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button class="btn" type="submit" name="save" >Save</button>
        <?php endif ?>

		</div>
	</form>
</body>
</html>
<?php  include('footer.php'); ?>