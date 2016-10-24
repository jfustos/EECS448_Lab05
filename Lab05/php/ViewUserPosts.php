<?php

echo '<link rel="stylesheet" type="text/css" href="../css/style.css">';

function startTable( $name )
{
	echo "<h1>$name</h1>\n";
	echo "<table>\n";
	echo "<tr>\n";
	return;
}

function stopTable()
{
	echo "</tr>\n";
	echo "</table>\n";
	return;
}

function tableEntry( $value, $bold )
{
	$prefix = "";
	$postfix = "";
	if( $bold == 'BOLD' )
	{
		$prefix = "<b>";
		$postfix = "</b>";
	}
	
	echo "<td>$prefix$value$postfix</td>";
	return;
}

function nextRow()
{
	echo "\n</tr>\n<tr>\n";
	return;
}

$userName = $_POST["userName"];
$userLen = strlen( $userName );
if ( $userLen <= 0 || $userLen > 32 )
{
    echo "ERROR: User name needs to be between 1 and 32 characters.<br>";
    echo "Could not look up user |$userName|!!!!<br>";
}

$mysqli = new mysqli("mysql.eecs.ku.edu", "jfustos", "eRaCU4DAvWnXhJuE", "jfustos");

if ($mysqli->connect_errno) 
{
	printf("ERROR: Connect failed: %s", $mysqli->connect_error);
	echo "<br> Could not get posts for user |$userName|!!!!<br>";
	exit();
}

$query = "SELECT content FROM Posts WHERE author_id='$userName' ORDER BY post_id";

$result = $mysqli->query($query);
if( ! $result )
{
	printf("ERROR: database says: %s", $mysqli->error);
	echo "<br> Could not get posts for user |$userName|!!!!<br>";
	exit();
}

startTable( "Posts for user $userName" );

tableEntry( "Post", 'BOLD' );

while( $row = $result->fetch_assoc() )
{
	nextRow();
	$currentPost = $row["content"];
	tableEntry( "$currentPost");
}

stopTable();

?> 
