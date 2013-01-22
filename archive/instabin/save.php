<?php
if (isset($_POST['ta'])) {
	$length = 3;
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~-_+';

	if ($string = $_POST['custom']){}

	else {
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
	}	

	if (file_exists("s/$string/index.html")) {
		echo "<script>alert('The custom URL $string already exists :(')</script>";
		header("Location: http://mtthw.me/instabin");
	}

	else {
		$myFile = "s/$string.html";
		$fh = fopen($myFile, 'w') or die("Can't open file");
		$a = file_get_contents('a.html');
		$b = $_POST['ta'];
		$c = file_get_contents('b.html');
		$stringData = $a . $b . $c;
		fwrite($fh, $stringData);
		fclose($fh);
	
		header("Location: s/$string");
	}
}
?>
