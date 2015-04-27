<p>This is $_POST:</p>
<?php
var_dump( $_POST );

foreach ( $_POST as $input => $value ) {
	$$input = strip_tags( $value );
}
?>

<p>Here are the newly created variables:</p>
<p>$your_name = <?php echo $your_name; ?></p>
<p>$your_email = <?php echo $your_email; ?></p>