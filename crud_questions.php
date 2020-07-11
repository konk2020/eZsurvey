<?php  include('survey_header.php'); ?>
<?php  include('crud_questions_process.php'); ?>



<?php 
	if (isset($_GET['edit'])) {
		$rec_id = $_GET['edit'];
        $update = true;
        
        $conn = OpenCon();
        $sql = "SELECT * from questions where rec_id='$rec_id'";    
        $result = $conn->query($sql);
        //$record = $result->num_rows;

		if ($result->num_rows == 1 ) {
			$n = $result->fetch_array();
            $state = $n['state'];
            $question_id = $n['question_id'];
            $regulated = $n['regulated'];
            $question = $n['question'];
            $options = $n['options'];
            $goto_if_yes = $n['goto_if_yes'];
            $goto_if_no = $n['goto_if_no'];
            $company_code = $n['company_code'];
            $rec_id = $n['rec_id'];
		}
	}
            // query all the company codes and their company names
			$conn = OpenCon();
			$sql = "SELECT company_code, company_name from company";    
			$resultSetComp = $conn->query($sql);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Company Questions</title>
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
        $sql = "SELECT * from questions";    
        $result = $conn->query($sql);
       
?>

<table>
	<thead>
   
 		<tr>
			<th>State</th>
            <th>Question #</th>
            <th>Regulated</th>
            <th>Question</th>
            <th>Go to if yes</th>
            <th>Go to if no</th>
			<th>Company Code</th>
		</tr>
	</thead>
	
	<?php while ($row = $result->fetch_array()) { ?>
		<tr>
			<td><?php echo $row['state']; ?></td>
            <td><?php echo $row['question_id']; ?></td>
            <td><?php if($row['regulated'] == 1) { echo "Yes";} else {echo "No";} ?></td>
            <td><?php echo $row['question']; ?></td>
            <td><?php echo $row['goto_if_yes']; ?></td>
            <td><?php echo $row['goto_if_no']; ?></td>
            <td><?php echo $row['company_code']; ?></td>

			<td>
				<a href="crud_questions.php?edit=<?php echo $row['rec_id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="crud_questions_process.php?del=<?php echo $row['rec_id']; ?>" class="del_btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>



	<form method="post" action="crud_questions_process.php">
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
			<label>Question #</label>
			<input type="text" name="question_id" value="<?php echo $question_id; ?>">
		</div>
        <div class="input-group">
			<label>Regulated</label>
            <select name="regulated">
			<?php echo "<option value='$regulated' selected >".($regulated==1?'Yes':'No')."</option>"; ?>
            <option value="0">No</option>
            <option value="1">Yes</option>
            </select>
		</div>
        <div class="input-group">
			<label>Question</label>
			<input type="text" name="question" value="<?php echo $question; ?>">
		</div>
        <div class="input-group">
			<label>Go to question/message if yes</label>
			<input type="text" name="goto_if_yes" value="<?php echo $goto_if_yes; ?>">
		</div>
         <div class="input-group">
			<label>Go to question/message if no</label>
            <input type="text" name="goto_if_no" value="<?php echo $goto_if_no; ?>">
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
            <?php echo "<input type='hidden' name='rec_id' value='$rec_id'>" ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
        <?php else: ?>
            <button class="btn" type="submit" name="save" >Save</button>
        <?php endif ?>

		</div>
	</form>
    <?php 

        $conn = OpenCon();
        $sql = "SELECT * from messages";    
        $result = $conn->query($sql);
       
?>
<!--Messages table under the form-->
<h2 style="text-align: center;">Messages</h2>
<p style="text-align: center;">Use this table as a reference for messages for fields <b>'Go to question/message if yes'</b> and <b>'Go to question/message if no'</b></p>
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
            <td><?php if($row['regulated'] == 1) {echo "Yes";} else {echo "No";} ?></td>
            <td><?php echo $row['message']; ?></td>
            <td><?php echo $row['company_code']; ?></td>
		</tr>
	<?php } ?>
</table>
</body>
</html>
<?php  include('footer.php'); ?>