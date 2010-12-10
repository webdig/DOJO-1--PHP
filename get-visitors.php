<?php

$page = $_GET['page'];
$per_page = $_GET['visitors_per_page'];

$mysqli = new mysqli( 'localhost', 'javayaht_dig', 'd1gp@ss', 'javayaht_dig' );

$result = $mysqli->query( 'SELECT name, message FROM visitors ORDER BY id LIMIT ' . ($page * $per_page) . ',' . $per_page );

//sleep(1);

if ($result) {
	while ( $row = $result->fetch_assoc() ) {
		echo "<div class=\"visitor\"><div class=\"visitor-inner\"><div class=\"visitor-header\"><div class=\"gravatar\"><img src=\"http://1.gravatar.com/avatar/" .
			md5($row['name']) . '?s=32&d=identicon&r=G" /></div></div><div class="author">' .
			$row['name'] . "</div><div class=\"message\">" . nl2br( $row['message'] ) . "</div></div><div class=\"gradient\"></div></div>";
	}
}

