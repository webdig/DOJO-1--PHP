<?php
$entries_per_page = 5;

$mysqli = new mysqli( 'localhost', 'javayaht_dig', 'd1gp@ss', 'javayaht_dig' );

$result = $mysqli->query( 'SELECT COUNT(id) AS visitor_count FROM visitors' );

if ($result) {
	$row = $result->fetch_assoc();
	$visitor_count = intval($row['visitor_count']);
	$result->close();
} else {
	$visitor_count = 0;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Awesome Guestbook</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="js/jquery.pagination.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
		<link rel="stylesheet" href="css/dark-hive/jquery-ui-1.8.6.custom.css" />
		<!-- <link rel="stylesheet" href="https://github.com/gbirke/jquery_pagination/raw/master/src/pagination.css" /> -->
		<script type="text/javascript">
			var visitors_per_page = <?php echo $entries_per_page; ?>;
			var visitor_count = <?php echo $visitor_count; ?>;
			var loading = false;
			
			jQuery(document).ready(function($) {
				setupPagination();
				//loadPage(0);
				//current ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only
				
				//$('.navigation a, .navigation span').button();
				$('#sign a').click(function() {
					
				});
			});
			
			function loadPage(page) {
				$('#guests').fadeTo("fast", 0, function(){
						loading = true;
						setTimeout(showLoading, 200);
						$.get( 'get-visitors.php', {
								page : page,
								visitors_per_page : visitors_per_page
							}, function(response) {
								loading = false;
								$('#loading').css("background" , "none");
								$('#guests').html(response).fadeTo("fast", 1);
							}, 'text');
					});
				return false;
				
				/*$.get( 'get-visitors.php', {
						page : page,
						visitors_per_page : visitors_per_page
					}, function(response) {
						$('#guests').fadeOut("fast", function(){$(this).html(response).fadeIn()});
					}, 'text');
				return false;*/
			}
			
			function showLoading() {
				if (loading)
					$('#loading').css("background" , "url(images/loader2.gif) no-repeat center center");
			}
			
			function setupPagination() {
				$('.navigation').pagination(visitor_count, {
					items_per_page : visitors_per_page,
					callback : loadPage,
					num_display_entries : 5
				});
			}
			
		</script>
		
		<style type="text/css">
			.title {
				text-align: center;
				margin: 20px auto;
				margin-top: 50px;
				color: #eee;
				border-radius: 5px;
				-moz-border-radius: 5px;
				border: 1px solid #555;
				padding: 20px;
				width: 400px;
				background: -moz-repeating-linear-gradient(top, #333, #111 100%);
				background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#333), to(#111));
				-webkit-box-shadow: 0 0 10px #3c649b;
				-moz-box-shadow: 0 0 10px #3c649b;
				font-size: 30px !important;
			}
			
			body {
				color: #ccc;
				font-family: Tahoma;
				font-weight: bold;
				text-shadow: 1px 1px #000;
				background-image: url(http://jqueryui.com/themeroller/images/?new=000000&w=21&h=21&f=png&q=100&fltr[]=over|textures/14_loop.png|0|0|25);
			}
			
			#loading {
				clear: both;
				min-height: 70px;
			}
			
			a {
				color: #ccc;
			}
			#error {
				font-weight: bold;
				color: red;
			}
			#guest-outer-div {
				margin: 20px auto;
				color: #eee;
				border-radius: 5px;
				-moz-border-radius: 5px;
				border: 1px solid #555;
				padding: 25px 20px;
				width: 400px;
				background: -moz-repeating-linear-gradient(top, #333, #111 100%);
				background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#333), to(#111));
				-webkit-box-shadow: 0 0 10px #3c649b;
				-moz-box-shadow: 0 0 10px #3c649b;
			}
			
			#guest-div table {
				width: 100%;
			}
			
			.gradient {
				margin-top: 5px;
				background: -moz-repeating-linear-gradient(left, rgba(52, 178, 249,0) 0%, #3c649b 50%, rgba(52, 178, 249,0) 100%);
				background: -webkit-gradient(linear, 0% 0%, 100% 0%, from(rgba(52, 178, 249,0)), color-stop(50%, #3c649b), to(rgba(52, 178, 249,0)));
				height: 1px;
			}
			
			.author {
				font-size: 18px;
				padding-top: 14px;
				margin-left: 5px;
			}
			
			.visitor {
				margin-top: 10px;
			}
			
			.gravatar {
				float: left;
			}
			
			.author {
				float: left;
			}
			
			.message {
				clear: both;
				font-size: 14px;
				padding: 0 20px;
				padding-top: 5px;
			}
			
			.navigation {
				margin-top: 15px;
				text-align: center;
			}
			
			.navigation a,
			.navigation span { color: #666; display: inline-block; position: relative; padding: 3px; margin-right: .1em; text-decoration: none !important; text-align: center; zoom: 1; overflow: visible; } /* the overflow property removes extra width in IE */
			
			.navigation a {
				color: white;
			}
			
			.navigation span {
				cursor: default;
			}
			
			
			.navigation span,
			.navigation a {
				margin: 0 5px;
				font-size: 14px;
			}
			
			#sign {
				float: right;
			}
			
			#sign a {
				font-size: 16px;
				color: #fff;
				text-shadow: 1px 1px rgba(0,0,0,.75);
				text-decoration: none;
				background: -moz-repeating-linear-gradient(top, rgba(134, 189, 224 , 1) 0%, rgba(90, 110, 193 , 1) 100%);
				background: -moz-repeating-linear-gradient(top, rgba(77, 156, 229 , 1) 0%, rgba(20, 59, 111 , 1) 100%);
				background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgba(77, 156, 229 , 1)), to(rgba(20, 59, 111 , 1)));
				border: 1px solid #89b6e5;
				padding: 5px;
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
				-moz-box-shadow: 0 0 5px #7db6f0;
				-webkit-box-shadow: 0 0 5px #7db6f0;
			}
			
			#nav {
				font-size: 10px;
				text-align: center;
				margin: 20px auto;
				color: #eee;
				border-radius: 5px;
				-moz-border-radius: 5px;
				border: 1px solid #555;
				padding: 20px;
				width: 400px;
				background: -moz-repeating-linear-gradient(top, #333, #111 100%);
				background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#333), to(#111));
				-webkit-box-shadow: 0 0 10px #3c649b;
				-moz-box-shadow: 0 0 10px #3c649b;
			}
			.gbform {
				width:95%;
				padding:.4em;
				background:#000;
			}
			body { font-size: 62.5%; }
			label, input { display:block; }
			input.text { margin-bottom:12px; width:95%; padding: .4em; }
			fieldset { padding:0; border:0; margin-top:25px; }
			h1 { font-size: 1.2em; margin: .6em 0; }
			div#users-contain { width: 350px; margin: 20px 0; }
			div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
			div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
			.ui-dialog .ui-state-error { padding: .3em; }
			.validateTips { border: 1px solid transparent; padding: 0.3em; }
			.gbFormError{color:#FF0000;}
			.gbFormUIErrorOverride{background:url(" http://jqueryui.com/themeroller/images/?new=ffdc2e&w=40&h=40&f=png&q=100&fltr[]=over|textures/08_diagonals_thick.png|0|0|95") repeat scroll 50% 50% #FFDC2E}
		</style>
	</head>
	<body>
		<form method="post" action="" id="guestbook" />
			
		</form>
		<h2 class="title">Awesome Guestbook</h2>
		<div id="guest-outer-div">
			<div id="guest-div">
				<div id="sign">
					<a id="signguestbook" href="javascript:void(0);">Sign Guestbook</a>
				</div>
				<div id="loading">
					<table id="guests">
					</table>
				</div>
			</div>
			<div class="navigation"></div>
		</div>
		<div id="nav">
			&copy; <?php echo date('Y'); ?> Anderson Web Solutions LLC, FernFerret Studios
		</div>
	<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		var name = $( "#name" ),
			message = $( "#message" ),
			allFields = $( [] ).add( name ).add( message ),
			tips = $( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "gbFormError" );
			setTimeout(function() {
				tips.removeClass( "gbFormError", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			resizable: false,
			modal: true,
			buttons: {
				"Sign the Guestbook!": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength( name, "name", 1, 50 );
					bValid = bValid && checkLength( message, "message", 1, 140 );

					if ( bValid ) {
						$.get( 'submit-guest.php', {
								name : $('#name').val(),
								message: $('#message').val()
							}, function(response) {
								visitor_count = parseInt(response);
								setupPagination();
								$(".navigation").trigger('setPage', [Math.floor(visitor_count/visitors_per_page)]);
							}, 'text');
						$( this ).dialog( "close" );
					}
				},
				Cancel: function() {
					allFields.val( "" ).removeClass( "ui-state-error" );
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#signguestbook" )
			.click(function(event) {
				event.preventDefault();
				$( "#dialog-form" ).dialog( "open" );
				return false;
			});
	});
	</script>


	<div id="dialog-form" title="Sign the Awesome Guestbook!">
	<p class="validateTips">All form fields are required.</p>
		<form>
		<fieldset>
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all gbform" />
			<label for="message">Message</label>
			<textarea name="message" id="message" rows="4" cols="45" value="" class="text ui-widget-content ui-corner-all gbform"></textarea>
		</fieldset>
		</form>
	</div>
	</body>
</html>