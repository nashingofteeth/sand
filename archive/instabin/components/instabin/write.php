<?php
if (isset($_POST['data'])) {
	$length = 5;
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	if ($string = $_POST['custom']){}

	else {
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
	}

	if (file_exists("userData/$string.html")) {
		echo "The file $string.html exists";
	}

	else {
		$myFile = "userData/" . $string . ".html";
		$fh = fopen($myFile, 'w') or die("Can't open file");
		$stringData = $_POST['data'];
		fwrite($fh, $stringData);
		fclose($fh);

		header("Location: userData/$string.html");
	}
}
?>

<form method="post">
	<textarea required autofocus cols="50" rows="25" name="data"></textarea>
	<br/>
	custom url:<input type="text" name="custom"/>
	<br/>
	<input type="submit" value="save"/>
</form>
