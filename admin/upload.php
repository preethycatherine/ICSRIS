<?php
	$filename = $_FILES['file']['name'];
	$location = 'uploads/'.$filename;
	$file_extension = pathinfo($location, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);
	$image_ext = array("pdf","doc","docx");
	
	$response = 0;
	if(in_array($file_extension,$image_ext)){
	  // Upload file
	  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
		$response = $location;
	  }
	}

?>
	