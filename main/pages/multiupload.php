<?php
include 'connect.php';
if(isset($_POST['submit_product'])){
	$images_array= array();
	foreach ($_FILES['images']['name'] as $key => $val) {
		$uploadfile = $_FILES['images']['temp_name'][$key];
		$folder = "uploads/";
		$target_file = $folder.$_FILES['images']['name'][$key]
		if (move_uploaded_file($_FILES['images']['temp_name'][$key], "$folder".$_FILES["images"]["name"][$key])) {
			$images_array[] = $target_file;
			
		}
	}
}

if(!empty($images_array)){
	foreach($images_array as $src){
		echo "

           <ul>
              <li>
                 <img src='".$src."'>
              </li>
           </ul>
		";
	}
}
?>