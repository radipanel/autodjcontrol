<?php

	if( !preg_match( "/index.php/i", $_SERVER['PHP_SELF'] ) ) { die(); }

?>
<form action="" method="post" id="autoDJSettings">

	<div class="box">

		<?php

			// Check if a user has been selected
			if ( $_POST['submit'] ) {

				try {

					// First we clean the submitted data
	                                $centovaurl = $core->clean( $_POST['centovaurl'] );
	                                $centovauser = $core->clean( $_POST['centovausername'] );
	                                $centovapass = $core->clean( $_POST['centovapassword'] );

					if ( !$centovaurl or !$centovauser or !$centovapass ) {

						throw new Exception ( "All fields are required." );

					}

					// Now they have been cleaned, we update the autodj_options table
					$db->query( "INSERT INTO autodj_options VALUES (NULL, '{$centovaurl}', '{$centovauser}', '{$centovapass}'); " );

					// Success, we tell them the good news!
					echo "<div class=\"square good\">";
					echo "<strong>Success</strong>";
					echo "<br />";
					echo "Auto DJ information updated!";
					echo "</div>";
;
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
					<strong>Auto DJ: Settings</strong>
				</div>

				<div class="content">
					
                                    <table width="100%" cellpadding="3" cellspacing="0">

					<?php

					// Select data already stored
					$query = $db->query( "SELECT * FROM autodj_options ORDER BY id DESC LIMIT 1" );
					$conn = $db->arr( $query );

					echo $core->buildField( "text",
									"required",
									"centovaurl",
									"Centova URL",
									"Centova Cast URL, ask your host!",
									$conn['centovaurl'] );

                                        echo $core->buildField( "text",
									"required",
									"centovausername",
									"Centova Username",
									"Enter the username of the stream.",
									$conn['centovauser'] );

                                        echo $core->buildField( "password",
									"required",
									"centovapassword",
									"Centova Password",
									"Enter the password of the stream.",
									$conn['centovapass'] );

					?>

					</table>

				<div class="box" align="right">
					<input class="button" type="submit" name="submit" value="Submit" />
				</div>

				<?php
					echo $core->buildFormJS('autoDJSettings');
                                ?>
               </div>
        </div>
</form>
