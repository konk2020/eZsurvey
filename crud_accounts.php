<?php  include('survey_header.php'); ?>
<?php  include('crud_accounts_process.php'); ?>

<?php 
  //  ini_set('display_errors', 1);
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
<h2 class="crud_title"><b><i>Accounts</i></b></h2>
<div class="container">
<table class="table table-striped">
	<thead class="thead-dark">
   
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
				<a href="crud_accounts.php?edit=<?php echo $row['id']; ?>" class="edit_btn btn btn-success" >Edit</a>
			</td>
			<td>
				<a href="crud_accounts_process.php?del=<?php echo $row['id']; ?>" class="del_btn btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
</div>


	<form method="post" action="crud_accounts_process.php">
		<fieldset class="form-group">
			<label class="form-lbl">Username</label>
            <?php if (isset($_GET['edit'])): ?>
            <input type="text" name="username" value="<?php echo $username; ?>" disabled class="form-control">
            <?php else: ?>
            <input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
            <?php endif ?>
           
		</fieldset>
		<fieldset class="form-group">
			<label class="form-lbl">Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>" class="form-control">
		</fieldset>
        <fieldset class="form-group">
			<label class="form-lbl">Email Verified</label>
			<select name="verified" class="form-control">
			<?php if (isset($_GET['edit'])) {echo "<option value='verified' selected >".($verified==1?'Yes':'No')."</option>";} else{echo "<option selected>--Select--</option>";} ?>
            <option value="0">No</option>
            <option value="1">Yes</option>
            </select>
		</fieldset>
        <fieldset class="form-group">
			<label class="form-lbl">Name</label>
			<input type="text" name="name" value="<?php echo $name; ?>" class="form-control">
		</fieldset>
        <fieldset class="form-group">
			<label class="form-lbl">Phone</label>
			<input type="tel" name="phone" value="<?php echo $phone; ?>" placeholder="(000) 000-0000" pattern="([0-9]3) [0-9]3-[0-9]4" class="form-control">
		</fieldset>
        <fieldset class="form-group">
			<label class="form-lbl">Role</label>
            <select name="role" class="form-control">
			<?php if (isset($_GET['edit'])) {echo "<option value='$role' selected >".$role."</option>";} else{echo "<option selected>--Select--</option>";}?>
            <option value="user">user</option>
            <option value="admin">admin</option>
            </select>
		</fieldset>
    
		<fieldset class="form-group">

        <?php if ($update == true): ?>
            <button class="btn btn-success" type="submit" name="update" >Update</button>
        <?php else: ?>
            <button class="btn btn-success" type="submit" name="save" >Save</button>
        <?php endif ?>

		</fieldset>
	</form>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php  include('footer.php'); ?>