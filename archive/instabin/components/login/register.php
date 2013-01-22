<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("test", $con);

if(isset($_POST['username']) && isset($_POST['password'])) {

$sql = "INSERT INTO members (emailaddr, username, password, data)
VALUES ('$_POST[emailaddr]', '$_POST[username]', '$_POST[password]', 'Enter some stuff!')";
if (mysql_query($sql,$con))
{
mkdir($_POST['username'], 0700);
echo "Register successfully :) <a href='login.php'>Login</a>";
}
else {
echo "Sorry there was an error :( " . mysql_error();
}
}
?>
<form method="post">
<b>Register</b><br/>
Email: <input type="email" name="emailaddr"/>
<br/>
Username: <input type="text" name="username"/>
<br/>
Password: <input type="password" name="password"/>
<br/>
<input type="submit" value="Register"/> or <a href="login.php">Login</a>
</form>
</form>