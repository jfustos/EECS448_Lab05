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

$deleteIDs;
if( isset($_POST['postNums']) && is_array($_POST['postNums']) )
{
	$deleteIDs = $_POST['postNums'];
}
else
{
	echo "Did not get any post IDs to delete, exiting!!!!<br>";
	exit();
}

$mysqli = new mysqli("mysql.eecs.ku.edu", "jfustos", "eRaCU4DAvWnXhJuE", "jfustos");

if ($mysqli->connect_errno) 
{
	printf("ERROR: Connect failed: %s", $mysqli->connect_error);
	echo "<br> Cannot delete posts, cannot access database!!!!<br>";
	exit();
}

startTable( "Attempting to delete posts" );

tableEntry( "Post ID", 'BOLD' );
tableEntry( "Status", 'BOLD' );

foreach( $deleteIDs as $curID )
{
	nextRow();
	tableEntry( "$curID");
	
	$query = "DELETE FROM Posts WHERE post_id='$curID'";
	$result = $mysqli->query($query);
	if( $result )
	{
		tableEntry( "Deleted", 'BOLD' );
	}
	else
	{
		$error = $mysqli->error;
		tableEntry( "ERROR: Could not delete entry: $error" );
	}
}

stopTable();

?> 
