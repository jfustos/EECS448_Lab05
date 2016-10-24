<?php

$userName = $_POST["userName"];
$userPost = $_POST["userPost"];

$userLen = strlen( $userName );
$postLen = strlen( $userPost );

if ( $userLen <= 0 || $userLen > 32 )
{
	echo "ERROR: User name needs to be between 1 and 32 characters.<br>";
	echo "Post was not added!!!!<br>";
}
else if( $postLen <= 0 )
{
	echo "ERROR: Post cannot be blank.<br>";
	echo "Post was not added!!!!<br>";
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
	
	$query = "SELECT user_id FROM Users WHERE user_id='$userName'";
	$result = $mysqli->query($query);
	
	if( mysqli_num_rows($result) <= 0 )
	{
		echo "ERROR: |$userName| is not a valid user.<br>";
		echo "Post was not added!!!!<br>";
		exit();
	}
	
	$query = "INSERT INTO Posts (content, author_id) VALUES ('$userPost', '$userName')";
	
	if( $mysqli->query($query) )
	{
		echo "SUCCESS: added post |$userPost| for user |$userName|!!!";
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
	echo "ERROR: Only characters a-z, A-Z, and 0-9 are valid for user name.<br>";
	echo "Post was not added!!!!<br>";
}

?> 
