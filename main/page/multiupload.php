<?php 
$countfiles = count($_FILES['images']['name']);
echo $countfiles;
$upload_location = "uploads/";
$files_arr = array();
for ($index=0; $index < $countfiles; $index++) { 
	if (isset($_FILES['images']['name'][$index]) && $_FILES['images']['name'][$index] !=''){
		$file_name = $_FILES['images']['name'][$index];
		$ext = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
		$valid_ext = array("png","jpeg","jpg");
      if(in_array($ext, $valid_ext)){
      $path = $upload_location.$file_name;
         if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $path)) {
         	$files_arr[] = $path;
         }
       }

	}
}
echo json_decode($files_arr);

?>
