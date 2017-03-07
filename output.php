	<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
	$old = ini_set('memory_limit', '100000000000M');
	$target_dir = "temp/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$bin = array();
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	    	$filename = $target_dir . $_FILES["fileToUpload"]["name"];
			$handle = fopen($filename, "rb");
			$contents = fread($handle, filesize($filename));
			for ($i = 0; $i < strlen($contents); $i++) {
			    $binary = sprintf("%08d", base_convert(ord($contents[$i]), 10, 2));
			    array_push($bin, 300 + 9690/255 * bindec($binary));
			}
			$binjs = json_encode($bin);
			fclose($handle);
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

	$final = array();

	for ($i = 0; $i < count($bin); $i++) {
		array_push($final, file_get_contents("freq/".$bin[$i].'.wav'));
	}
	$rand = rand ( 100000 , 999999 );
	file_put_contents('temp/'.$rand.'.wav',implode('',$final));

	$file = "temp/".$rand.".wav"; 

	header("Content-Description: File Transfer"); 
	header("Content-Type: application/octet-stream"); 
	header("Content-Disposition: attachment; filename='" . basename($file) . "'"); 

	readfile ($file);

	header("Location: /temp/".$rand.".wav")
?>

</body>
</html>