<?php
	if (isset($_POST['url'])) { 
		echo file_get_contents($_POST['url']);
	}
?>
