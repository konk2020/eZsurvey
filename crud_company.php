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

		if ($result->num_rows == 1) {
			$n = $result->fetch_array();
			$compnay_code = $n['company_code'];
            $company_name = $n['company_name'];
            $address = $n['address'];
            $address2 = $n['address2'];
            $city = $n['city'];
            $state = $n['state'];
            $zipcode = $n['zipcode'];
            $logo = $n['logo'];
        }
	}

            // query all the company codes
			$conn = OpenCon();
			$sql = "SELECT company_code from company";    
			$resultSetComp = $conn->query($sql);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Company Information</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
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
<h2 class="crud_title"><b><i>Company</i></b></h2>
<div class="container">
<table class="table table-striped">
	<thead class="thead-dark">
   
 		<tr>
			<th>Company Code</th>
            <th>Company Name</th>
            <th>Address</th>
            <th>Address2</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
            <th>Logo</th>
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
            <td><img src="<?php echo $row['logo']; ?>" width="50" height="50"/></td>

			<td>
				<a href="crud_company.php?edit=<?php echo $row['company_code']; ?>" class="edit_btn btn btn-success" >Edit</a>
			</td>
			<td>
				<a href="crud_company_process.php?del=<?php echo $row['company_code']; ?>" class="del_btn btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
</div>


	<form method="post" action="crud_company_process.php">
		<fieldset class="form-group">
			<label class="form-lbl">Company Code</label>
            <?php if (isset($_GET['edit'])): ?>
            <input type="text" name="company_code" value="<?php echo $company_code; ?>" disabled class="form-control">
            <?php else: ?>
            <input type="text" name="company_code" value="<?php echo $company_code; ?>" placeholder="Ex: OEZ" class="form-control">
             <?php endif ?>
            
		</fieldset>
		<fieldset class="form-group">
			<label class="form-lbl">Company Name</label>
			<input type="text" name="company_name" value="<?php echo $company_name; ?>" class="form-control">
		</fieldset>
        <fieldset class="form-group">
			<label class="form-lbl">Address</label>
			<input type="text" name="address" value="<?php echo $address; ?>" class="form-control">
		</fieldset>
        <fieldset class="form-group">
			<label class="form-lbl">Address 2</label>
			<input type="text" name="address2" value="<?php echo $address2; ?>" class="form-control">
		</fieldset>
        <fieldset class="form-group">
			<label class="form-lbl">City</label>
			<input type="text" name="city" value="<?php echo $city; ?>" class="form-control">
		</fieldset>
        <!--DROPDOWN FOR ALL THE STATES-->
		<fieldset class="form-group">
			<label class="form-lbl">State</label>
			<select name="state" value="<?php echo $state; ?>" class="form-control">
			   <?php if (isset($_GET['edit'])) {echo "<option value='$state' selected>".$state."</option>";} else { echo "<option selected>--Select--</option>";} ?>
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
			<label class="form-lbl">Zip Code</label>
			<input type="text" name="zipcode" value="<?php echo $zipcode; ?>" class="form-control">
		</fieldset>
		<fieldset class="form-group">

        <?php if ($update == true): ?>
            <button class="btn btn-success" type="submit" name="update">Update</button>
        <?php else: ?>
            <button class="btn btn-success" type="submit" name="save">Save</button>
        <?php endif ?>

		</fieldset>
	</form>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php  include('footer.php'); ?>