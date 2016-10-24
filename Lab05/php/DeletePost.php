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
	echo "<br> Could not get posts!!!!<br>";
	exit();
}

$query = "SELECT * FROM Posts ORDER BY post_id";

$result = $mysqli->query($query);
if( ! $result )
{
	printf("ERROR: database says: %s", $mysqli->error);
	echo "<br> Could not get posts!!!!<br>";
	exit();
}

echo '<form action="../php/DeletePostResponse.php" method="post">';
echo "\n";

startTable( "All Posts" );

tableEntry( "authors", 'BOLD' );
tableEntry( "posts", 'BOLD' );
tableEntry( "delete", 'BOLD' );

while( $row = $result->fetch_assoc() )
{
	nextRow();
	$author_id = $row["author_id"];
	tableEntry( "$author_id");
	$currentPost = $row["content"];
	tableEntry( "$currentPost");
	$postNum = $row["post_id"];
	$my_check = '<input type="checkbox" name="postNums[]" value="' . $postNum . '" />';
	tableEntry( $my_check );
}

stopTable();

echo '<br></br><input type="submit">';
echo "\n</form>\n";

?> 
