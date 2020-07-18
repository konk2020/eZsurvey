<?php  include('survey_header.php'); ?>
<?php  include('crud_messages_process.php'); ?>

<?php 
	if (isset($_GET['edit'])) {
		$rec_id = $_GET['edit'];
        $update = true;
        
		$conn = OpenCon();
		//console_log('im here'.$rec_id);
        $sql = "SELECT * from messages where rec_id='$rec_id'";    
        $result = $conn->query($sql);
        //$record = $result->num_rows;

		if ($result->num_rows == 1 ) {
			$n = $result->fetch_array();
			$state = $n['state'];
            $message_id = $n['message_id'];
            $regulated = $n['regulated'];
            $message = $n['message'];
			$company_code = $n['company_code'];
			$rec_id = $n['rec_id'];
			//console_log('im here' .$rec_id);
		}
	}
		//if ($update==true) { 
			// set the company code for the drop down
		//	$conn = OpenCon();
		//$sql = "SELECT company_code from company where company_code='$company_code'";  
		//	$resultSetComp = $conn->query($sql);
		//} else {
			// query all the company codes
			$conn = OpenCon();
			$sql = "SELECT company_code, company_name from company";    
			$resultSetComp = $conn->query($sql);
	//	}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Message Information</title>
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
        $sql = "SELECT * from messages";    
        $result = $conn->query($sql);
       
?>
<h2 class="crud_title"><b><i>Messages</i></b></h2>
<div class="container">
<table class="table table-striped">
	<thead class="thead-dark">
   
 		<tr>
			<th>State</th>
            <th>Message ID</th>
            <th>Regulated</th>
            <th>Message</th>
            <th>Company Code</th>
            <th></th>
            <th></th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
			<td><?php echo $row['state']; ?></td>
            <td><?php echo $row['message_id']; ?></td>
            <td><?php if($row['regulated'] == 1) {echo "Yes";} else {echo "No";} ?></td>
            <td><?php echo $row['message']; ?></td>
            <td><?php echo $row['company_code']; ?></td>

			<td>
				<a href="crud_messages.php?edit=<?php echo $row['rec_id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="crud_messages_process.php?del=<?php echo $row['rec_id']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
</div>



	<form method="post" action="crud_messages_process.php">
        <!--DROPDOWN FOR ALL THE STATES-->
		<fieldset class="form-group">
			<label class="form-lbl">State</label>
			<select name="state" value="<?php echo $state; ?>" class="form-control">
			   <?php if (isset($_GET['edit'])) {echo "<option value='$state' selected >".$state."</option>";} else{ echo "<option selected>--Select--</option>";} ?>
	           <option value="AL">Alabama</option>
	           <option value="AK">Alaska</option>
	           <option value="AZ">Arizona</option>
	           <option value="AR">Arkansas</option>
	           <option value="CA">California</option>
	           <option value="CO">Colorado</option>
	           <option value="CT">Connecticut</option>
	           <option value="DE">Delaware</option>
	           <option value="DC">District Of Columbia</option>
	           <option value="FL">Florida</option>
	           <option value="GA">Georgia</option>
	           <option value="HI">Hawaii</option>
	           <option value="ID">Idaho</option>
	           <option value="IL">Illinois</option>
	           <option value="IN">Indiana</option>
	           <option value="IA">Iowa</option>
	           <option value="KS">Kansas</option>
	           <option value="KY">Kentucky</option>
	           <option value="LA">Louisiana</option>
	           <option value="ME">Maine</option>
	           <option value="MD">Maryland</option>
	           <option value="MA">Massachusetts</option>
	           <option value="MI">Michigan</option>
	           <option value="MN">Minnesota</option>
	           <option value="MS">Mississippi</option>
	           <option value="MO">Missouri</option>
	           <option value="MT">Montana</option>
	           <option value="NE">Nebraska</option>
	           <option value="NV">Nevada</option>
	           <option value="NH">New Hampshire</option>
	           <option value="NJ">New Jersey</option>
	           <option value="NM">New Mexico</option>
	           <option value="NY">New York</option>
	           <option value="NC">North Carolina</option>
	           <option value="ND">North Dakota</option>
	           <option value="OH">Ohio</option>
	           <option value="OK">Oklahoma</option>
	           <option value="OR">Oregon</option>
	           <option value="PA">Pennsylvania</option>
	           <option value="RI">Rhode Island</option>
	           <option value="SC">South Carolina</option>
	           <option value="SD">South Dakota</option>
	           <option value="TN">Tennessee</option>
	           <option value="TX">Texas</option>
	           <option value="UT">Utah</option>
	           <option value="VT">Vermont</option>
	           <option value="VA">Virginia</option>
	           <option value="WA">Washington</option>
	           <option value="WV">West Virginia</option>
	           <option value="WI">Wisconsin</option>
	           <option value="WY">Wyoming</option>
            </select>
           
		</fieldset>
		<fieldset class="form-group">
			<label class="form-lbl">Message ID</label>
			<input type="text" name="message_id" value="<?php echo $message_id; ?>" class="form-control">
		</fieldset>
        <!--DROPDOWN FOR REGULATED FIELD-->
        <fieldset class="form-group">
			<label class="form-lbl">Regulated</label>
            <select name="regulated" class="form-control">
			<?php if (isset($_GET['edit'])) {echo "<option value='$regulated' selected >".($regulated==1?'Yes':'No')."</option>";} else{ echo "<option selected>--Select--</option>";} ?>
            <option value="0">No</option>
            <option value="1">Yes</option>
            </select>
		</fieldset>
        <fieldset class="form-group">
			<label class="form-lbl">Message</label>
			<input type="text" name="message" value="<?php echo $message; ?>" class="form-control">
		</fieldset>
        <!--DROPDOWN FOR COMPANY CODE FIELD-->
        <fieldset class="form-group">
			<label class="form-lbl">Company Code</label>
            <select name="company_code" class="form-control">
			<option value="" selected disabled hidden>Choose here</option>
		<?php 
            if (isset($_GET['edit'])) {echo "<option value='$company_code' selected >".$company_code."</option>";} else{ echo "<option selected>--Select--</option>";} 
            while($rows = $resultSetComp->fetch_assoc()) {
			$company_codeDisplay = $rows["company_code"] . " - " . $rows['company_name'];
			$company_code = $rows["company_code"];
			echo "<option value='$company_code'>$company_codeDisplay</option>";
		}   
        ?>
        </select>
		</fieldset>
    
		<fieldset class="form-group">

		<?php if ($update == true): ?>
			<?php echo "<input type='hidden' name='rec_id' value='$rec_id'>" ?>
            <button class="btn btn-succes" type="submit" name="update" >Update</button>
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