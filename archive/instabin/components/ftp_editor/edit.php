<?php
if (isset($_GET['host']) && isset($_GET['username']) && isset($_GET['password']) && isset($_GET['file'])) {
echo "<form method='post'>\n";
echo "<textarea name='data'>" . file_get_contents("http://" . $_GET['host'] . "/" . $_GET['file']) . "</textarea>\n";
echo "<input type='submit' value='Save'/>\n";
echo "</form>\n";

if (isset($_POST['data'])) {
$conn = ftp_connect($_GET['host']) or die("Could not connect");
ftp_login($conn,$_GET['username'],$_GET['password']);

echo ftp_put($conn,$_GET['file'],$_POST['data'],FTP_ASCII);

ftp_close($conn);
}
}
else {
header("Location: index.php");
}
?>