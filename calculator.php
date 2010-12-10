<?php
define( 'DAYS_IN_WEEK', 7);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Calendar</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#calculator').submit(function(event) {
					event.preventDefault();
					var equation = $('#equation').val();
					
					$.post( 'calculate.php', {
							'equation' : equation
						}, function(response) {
							$('#result').html(response);
						}, 'text');
					return false;
				});
			});
		</script>
		<style type="text/css">
			#error {
				font-weight: bold;
				color: red;
			}
		</style>
	</head>
	<body>
		<form method="post" action="" id="calculator" />
			<input type="text" name="equation" id="equation" /> <input type="submit" id="submit" value="=" /> <span id="result"></span>
		</form>
	</body>
</html>