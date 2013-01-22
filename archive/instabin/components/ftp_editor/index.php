<?php
if (isset($_GET['host']) && isset($_GET['username']) && isset($_GET['password']) && isset($_GET['folder']) && isset($_GET['file'])) {
$myFile = "file.txt";
$conn = ftp_connect($_GET['host']) or die("Could not connect");
ftp_login($conn,$_GET['username'],$_GET['password']);

if (ftp_fget($conn, $myFile, $_GET['folder'] . "/" . $_GET['file'], FTP_ASCII,0)) {
echo "I'm happy cause it works! :D";
}
else {
echo ":(";
}

echo "<form method='post'>\n";
echo "<textarea name='data'>" . file_get_contents($myFile) . "</textarea>\n";
echo "<input type='submit' value='Save'/>\n";
echo "</form>\n";

if (isset($_POST['data'])) {
$fh = fopen($myFile, 'w') or die("Can't open file");
$stringData = $_POST['data'];

fwrite($fh, $stringData);
fclose($fh);

ftp_put($conn,$_GET['folder'] . "/" . $_GET['file'],$myFile,FTP_ASCII);

ftp_close($conn);
}
}
else {
echo "<form id='form' method='get'>
Host: http://<input type='text' name='host'/>
<br/>
Username: <input type='text' name='username'/>
<br/>
Password: <input type='password' name='password'/>
<br/>
Folder: <input type='text' name='folder'/>
<br/>
File: <input type='text' name='file'/>
<br/>
<input type='submit' value='open'/>
</form>";
}
?>