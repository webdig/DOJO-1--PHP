<?php

$equation = $_POST['equation'];

$matches = array();

if ( preg_match( '/^-?([0-9]*\.?[0-9]+)\s*([\+-\/\*])\s*(-?[0-9]*\.?[0-9]+)$/', $equation, $matches ) ) {
	array_shift($matches);
	
	$left = floatval(array_shift($matches));
	$op = array_shift($matches);
	$right = floatval(array_shift($matches));
	
	switch($op) {
		case '+':
			echo $left + $right;
			break;
		case '-':
			echo $left - $right;
			break;
		case '/':
			if ( $right == 0 ) {
				echo 'NaN<br/><span id="error">Can\'t Divide By Zero!</span>';
			} else {
				echo $left / $right;
			}
			break;
		case '*':
			echo $left * $right;
			break;
		default:
			echo "WTF";
	}
}

?>