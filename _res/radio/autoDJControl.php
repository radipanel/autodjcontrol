<?php

	if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

?>
<form action="" method="post" id="autoDJSettings">

	<div class="box">

		<?php

			// Check if a user has been selected
			if ( isset( $_POST['submit'] ) ) {

				try {

					// Now we grab their connection details and put them into an array
					$query = $db->query( "SELECT * FROM connection_info ORDER BY id DESC LIMIT 1" );
					$conn = $db->assoc( $query );

					// Now we grab their autodj details and put them into an array
					$query2 = $db->query( "SELECT * FROM autodj_options ORDER BY id DESC LIMIT 1" );
					$conn2 = $db->assoc( $query2 );

					// And populate the configuration options
					$centovacast_url = $conn2['centovaurl'];
					$stream_username = $conn2['centovauser'];
					$stream_password = $conn2['centovapass'];
					$admin_password = '';
					$dj_password = $conn['password'];

					// Include Centova Classes
					require_once('_inc/autodj/centovacast/class_HTTPRetriever.php');
					require_once('_inc/autodj/centovacast/ccapiclient.php');

					// Prepare the API
					$ccurl = strlen($centovacast_url) ? $centovacast_url : 'http' . ($_SERVER['HTTPS']?'s':'') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']).'/';
					$server = new CCServerAPIClient($ccurl);
					$password = strlen($admin_password) ? 'admin|'.$admin_password : $stream_password;

					switch ( $_POST['submit'] ) {

						case "start_autodj":

							// They want to start the AutoDJ
							$arguments = array(
							
								"state" => "up" );

							$server->call('switchsource',$stream_username,$password,$arguments);
			
							if ( !$server->success ) {
				
								throw new Exception( $server->message );
							}
							else {
			
								echo "<div class=\"square good\">";
								echo "<strong>Success</strong>";
								echo "<br>";
								echo "AutoDJ started!";
								echo "</div>";

							}
							break;

						case "stop_autodj":

							// They want to start the AutoDJ
							$arguments = array(
							
								"state" => "down" );

							$server->call('switchsource',$stream_username,$password,$arguments);
			
							if ( !$server->success ) {
				
								throw new Exception( $server->message );
							}
							else {
			
								echo "<div class=\"square good\">";
								echo "<strong>Success</strong>";
								echo "<br>";
								echo "AutoDJ stopped!";
								echo "</div>";

							}
							break;
					}

				}
				catch( Exception $e ) {

					echo "<div class=\"square bad\">";
					echo "<strong>Error</strong>";
					echo "<br />";
					echo $e->getMessage();
					echo "</div>";

				}

			}
			?>

				<div class="square title">
					<strong>Auto DJ: Control</strong>
				</div>

				<div class="content">
				
					<div style="height: 70px; text-align: center;">

					<input type="image" src="../../_img/play.png" name="submit" value="start_autodj" alt="Start AutoDJ" style="padding: 5px;">
					<input type="image" src="../../_img/stop.png" name="submit" value="stop_autodj" alt="Stop AutoDJ" style="padding: 5px;">

					</div>

				</div>
        	</div>
</form>
