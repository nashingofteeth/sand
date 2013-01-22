<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  } 
mysql_select_db("test", $con);

//Create table
$sql = "CREATE TABLE members
(
personID int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(personID),
EmailAddr varchar(15),
UserName varchar(15),
PassWord varchar(15),
data text
)";

//Execute query
if (mysql_query($sql,$con))
{
echo "Table created!";
}
else {
echo " Error creating table " . mysql_error();
}
?>