<?php

if (!get_magic_quotes_gpc()) {
	$name = addslashes($_GET['name']);
	$message = addslashes($_GET['message']);
} else {
	$name = $_GET['name'];
	$message = $_GET['message'];
}

$mysqli = new mysqli( 'localhost', 'javayaht_dig', 'd1gp@ss', 'javayaht_dig' );

$mysqli->query( 'INSERT INTO visitors ( `name`, `message` ) VALUES ( \'' . $name . '\', \'' . $message . '\' )' );

$result = $mysqli->query( 'SELECT COUNT(id) AS visitor_count FROM visitors' );

if ($result) {
	$row = $result->fetch_assoc();
	echo $row['visitor_count'];
	$result->close();
} else {
	echo '0';
}

$mysqli->close();