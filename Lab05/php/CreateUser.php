<?php

$userName = $_POST["userName"];

$userLen = strlen( $userName );

if ( $userLen <= 0 || $userLen > 32 )
{
	echo "ERROR: User name needs to be between 1 and 32 characters.<br>";
	echo "User was not added!!!!<br>";
}
else if( preg_match( '/^[a-zA-Z0-9]{1,32}$/', $userName ) )
{
	$mysqli = new mysqli("mysql.eecs.ku.edu", "jfustos", "eRaCU4DAvWnXhJuE", "jfustos");
	
	if ($mysqli->connect_errno) 
	{
		printf("ERROR: Connect failed: %s", $mysqli->connect_error);
		echo "<br> User was not added!!!!<br>";
		exit();
	}
	
	$query = "INSERT INTO Users (user_id) VALUES ('$userName')";
	
	if( $mysqli->query($query) )
	{
		echo "SUCCESS: User name |$userName| was added!!!";
	}
	else
	{
		printf("ERROR: database says: %s", $mysqli->error);
		echo "<br> User was not added!!!!<br>";
		exit();
	}
}
else
{
	echo "ERROR: Only characters a-z, A-Z, and 0-9 are valid.<br>";
	echo "User was not added!!!!<br>";
}

?> 
