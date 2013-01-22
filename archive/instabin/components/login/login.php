<?php
session_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="members"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

if(isset($_POST['username']) && isset($_POST['password'])) {

// username and password sent from form 
$username=$_POST['username']; 
$password=$_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

$sql="SELECT * FROM $tbl_name WHERE username='$username' and password='$password'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);

if($count==1){
session_register("username");
session_register("password"); 
header("location:index.php");
}
else {
echo "Wrong Username or Password";
}
}
?>
<form method="post">
<b>Login</b><br/>
Username: <input name="username" type="text" id="username">
<br/>
Password: <input name="password" type="password" id="password">
<br/>
<input type="submit" name="Submit" value="Login"> or <a href="register.php">Register</a>
</form>