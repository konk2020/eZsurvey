
<!DOCTYPE html>
<html>
<head>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
</head>

<body>
    
<?php include 'survey_header.php'; ?>

<form name="form" method="post" action="logo_upload.php" enctype="multipart/form-data" style="margin: 0 auto;" >
<div style="text-align: center;">
<input type="file" name="my_file" /><br /><br />
<input type="submit" name="submit" value="Upload"/>
</div>
</form>

<?php include 'footer.php'; ?>
</body>
</html>
