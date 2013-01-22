<?php
if (isset($_POST['ta'])) {
	$length = 5;
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	if ($string = $_POST['custom']){}

	else {
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
	}	

	if (file_exists("d/$string/index.html")) {
		echo "$string already exists";
	}

	else {
		mkdir("d/$string", 0700);
		$myFile = "d/$string/index.html";
		$fh = fopen($myFile, 'w') or die("Can't open file");
		$stringData = $_POST['ta'];
		fwrite($fh, $stringData);
		fclose($fh);
	
		header("Location: d/$string");
	}
}

echo "<html>\n";
echo "<head>\n";
echo "<title>Instabin</title>\n";
echo "<script type='text/javascript' src='script.js'></script>\n";
echo "</head>\n";
echo "<frameset resizable='yes' cols='60%,*' onload='init();'>\n";
echo "<frame name='dynamicframe' src='javascript:'';'>\n";
echo "<frame name='editbox' src='javascript:'';'>\n";
echo "</frameset>\n";
echo "</html>\n";
?>