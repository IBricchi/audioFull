<!DOCTYPE html>
<html>
<head>
	<title>AudioFull</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>

<form action="output.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>


<?php 
$scheduledclean = strtotime("midnight"); // 00:00:00 of the current day
$lastcleanfile = 'temp/';
$lastcleantime = (file_exists($lastcleanfile)) ? filemtime($lastcleanfile) : 0;
$curtime = time();

if( ($curtime > $scheduledclean) && ($lastcleantime < $scheduledclean) ) {
    touch($lastcleanfile); //touch first to prevent multiple executions
    // file cleanup code here
}
/*for ($i=0; $i <255 ; $i++) { 
	$freqOfTone = 300+9690/255*$i;
	$sampleRate = 44100;
	$samplesCount = 1000;

	$amplitude = 0.25 * 32768;
	$w = 2 * pi() * $freqOfTone / $sampleRate;

	$samples = array();
	for ($n = 0; $n < $samplesCount; $n++) {
	    $samples[] = (int)($amplitude *  sin($n * $w));
	}

	$srate = 44100; //sample rate
	$bps = 16; //bits per sample
	$Bps = $bps/8; //bytes per sample /// I EDITED

	$str = call_user_func_array("pack",
	    array_merge(array("VVVVVvvVVvvVVv*"),
	        array(//header
	            0x46464952, //RIFF
	            160038,      //File size
	            0x45564157, //WAVE
	            0x20746d66, //"fmt " (chunk)
	            16, //chunk size
	            1, //compression
	            1, //nchannels
	            $srate, //sample rate
	            $Bps*$srate, //bytes/second
	            $Bps, //block align
	            $bps, //bits/sample
	            0x61746164, //"data"
	            160000 //chunk size
	        ),
	        $samples //data
	    )
	);
	$myfile = fopen('freq/'.$freqOfTone.".wav", "wb") or die("Unable to open file!");
	fwrite($myfile, $str);
	fclose($myfile);
}*/
?>

</body>
</html>