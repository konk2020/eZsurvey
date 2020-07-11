<?php  include('survey_header.php'); ?>
<?php  include('crud_company_process.php'); ?>

<?php 
    ini_set('display_errors', 1);
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
            
          
		  <td>  <?php //header("content-type: image/jpeg"); 
		  	    //echo $a=$row['logo'];
			    //echo base64_decode($a);?>
		  </td>

			<td>
				<a href="crud_company.php?edit=<?php echo $row['company_code']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="crud_company_process.php?del=<?php echo $row['company_code']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>



	<form method="post" action="crud_company_process.php">
		<div class="input-group">
			<label>Company Code</label>
            <?php if (isset($_GET['edit'])): ?>
            <input type="text" name="company_code" value="<?php echo $company_code; ?>" disabled>
            <?php else: ?>
            <input type="text" name="company_code" value="<?php echo $company_code; ?>" placeholder="Ex: OEZ">
            <?php endif ?>
		</div>
		<div class="input-group">
			<label>Company Name</label>
			<input type="text" name="company_name" value="<?php echo $company_name; ?>">
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
        <!--DROPDOWN FOR ALL THE STATES-->
		<div class="input-group">
			<label>State</label>
			<select name="state" value="<?php echo $state; ?>">
			   <?php echo "<option value='$state' selected >".$state."</option>"; ?>
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
           
		</div>
        <div class="input-group">
			<label>Zip Code</label>
			<input type="text" name="zipcode" value="<?php echo $zipcode; ?>">
		</div>
		<div class="input-group">

        <?php if ($update == true): ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button class="btn" type="submit" name="save">Save</button>
        <?php endif ?>

		</div>
	</form>
</body>
</html>
<?php  include('footer.php'); ?>