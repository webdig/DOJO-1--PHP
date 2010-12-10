<?php
define( 'DAYS_IN_WEEK', 7);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Calendar</title>
		<style type="text/css">
			body {
				font-family: Georgia;
			}
			table {
				border: 1px solid #ccc;
				border-spacing: 0;
			}
			th {
				font-family: Verdana;
				padding: 5px;
			}
			td {
				border-width: 0;
				border-top: 1px solid #ccc;
				padding: 7px 15px;
				margin: 0;
			}
		</style>
	</head>
	<body>
		<table>
			<tr><th colspan="<?php echo DAYS_IN_WEEK; ?>"><?php echo date('F, Y') ?></th></tr>
			<tr><th>S</th><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th></tr>
		<?php
			$week_begins = date('w', strtotime( date('1/m/Y') ) );
			
			echo '<tr>';
			for ( $i = 0; $i < $week_begins; $i++ ) {
				echo '<td>&nbsp;</td>';
			}
			
			$weekday = $week_begins;
		
			$days_in_month = intval( date('t') );
			for ( $i = 1; $i <= $days_in_month; $i++ ) {
				echo "<td>$i</td>";
				if ( ++$weekday == DAYS_IN_WEEK ) {
					$weekday = 0;
					echo "</tr>\n";
					echo '<tr>';
				}
			}
			
			while ( $weekday++ < DAYS_IN_WEEK ) {
				echo '<td>&nbsp;</td>';
			}
			
			echo '</tr>';
		?>
		</table>
	</body>
</html>