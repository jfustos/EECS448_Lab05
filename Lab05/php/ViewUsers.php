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

$mysqli = new mysqli("mysql.eecs.ku.edu", "jfustos", "eRaCU4DAvWnXhJuE", "jfustos");

if ($mysqli->connect_errno) 
{
	printf("ERROR: Connect failed: %s", $mysqli->connect_error);
	echo "<br> Could not get users!!!!<br>";
	exit();
}

$query = "SELECT user_id FROM Users";

$result = $mysqli->query($query);
if( ! $result )
{
	printf("ERROR: database says: %s", $mysqli->error);
	echo "<br> Could not get user list!!!!<br>";
	exit();
}

startTable( "Users" );

tableEntry( "User Name", 'BOLD' );

while( $row = $result->fetch_assoc() )
{
	nextRow();
	$currentName = $row["user_id"];
	tableEntry( "$currentName");
}

stopTable();

?> 
