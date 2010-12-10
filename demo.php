<?php

// Headers, content type
header( 'Content-type: text/plain' );

// Variables. Strings with variables
$name = 'Will';
echo "My name is $name\n\n";

// Get params, variables in strings
if ( empty( $_GET['name'] ) )
	echo "Hello, World!\n";
else
	echo "Hello, {$_GET['name']}!\n";

// Arrays
$users = array( 'John', 'Jane', 'Foo', 'Bar' );

// Modifying, appending
$users[0] = 'Bob';
$users[] = 'Will';

// Iterating
echo "\nUsers:\n";
foreach ( $users as $i => $user_name ) {
	echo "  $i: $user_name\n";
}

echo "\n";

// Debugging
print_r( $users );

// Associative arrays, iterating
$emails = array(
	'John'	=> 'john@gmail.com',
	'Jane'	=> 'jane@rose-hulman.edu',
	'Foo'	=> 'foo@hotmail.com',
	'Bar'	=> 'bar@baz.net'
);
$emails['John'] = 'john@aol.com';
$emails['Will'] = 'will@itsananderson.com';
echo "\n\nEmails:\n";
foreach ( $emails as $name => $email ) {
	echo "  $name:\t$email\n";
}

echo "\n";

// Debugging associative arrays
print_r( $emails );

// PHP Date function, string concatination
echo "\nToday's date is: " . date( 'm/d/Y' ) . "\n\n";


// MySQL connection example
$mysqli = new mysqli( 'localhost', 'root', '', 'dojo' );

$result = $mysqli->query( 'SELECT * FROM visitors' );

while ( $row = $result->fetch_assoc() ) {
	echo $row['id'] . "\t" . $row['name'] . "\t" . $row['message'] . "\n";
}


?>