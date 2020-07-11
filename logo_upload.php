<?php
session_start();
include_once 'global_functions.php';

if (($_FILES['my_file']['name']!="")){
// Where the file is going to be stored
 $target_dir = "images/";
 $file = $_FILES['my_file']['name'];
 $path = pathinfo($file);
 $filename = $path['filename'];
 $ext = $path['extension'];
 $temp_name = $_FILES['my_file']['tmp_name'];
 
 $company_code = get_company_code($_SESSION['userLogin']);
 $path_filename_ext = $target_dir.$company_code."_logo.".$ext;
 
console_log($path_filename_ext);

// Check if file already exists
if (file_exists($path_filename_ext)) {
 echo "Sorry, file already exists.";
 }else{
 move_uploaded_file($temp_name,$path_filename_ext);

 update_company_logo($path_filename_ext,$company_code );

 echo "Congratulations! File Uploaded Successfully.";
 }
}
?>