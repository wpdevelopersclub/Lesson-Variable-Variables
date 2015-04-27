<?php

$php    = array( 'PHP Lesson 1', 'PHP Lesson 2' );
$html   = array( 'HTML Lesson 1', 'HTML Lesson 2' );
$css    = array( 'CSS Lesson 1', 'CSS Lesson 2' );
$js     = array( 'JS Lesson 1', 'JS Lesson 2' );
?>

<h2>Verbose Way of coding it</h2>

<?php
//* Verbose way
switch( $_POST['filterby'] ) {
	case 'php':
		echo $php[ $_POST['lesson_number'] ];
		break;
	case 'html':
		echo $php[ $_POST['lesson_number'] ];
		break;
	case 'css':
		echo $php[ $_POST['lesson_number'] ];
		break;
	case 'js':
		echo $php[ $_POST['lesson_number'] ];
		break;
	default:
		echo 'You didn\'t select anything.';
} ?>

<h2>Variable variables way</h2>

<p>Syntax is:
	<pre>${$_POST[filterby]}[ $_POST['lesson_number'] ];</pre>, which produces this when echoed out:

<strong><?php echo ${$_POST[filterby]}[ $_POST['lesson_number'] ]; ?></strong>.</p>

<p>Without the braces around the variable that points to the existing variable, i.e. $_POST['filterby'],
will produce a value of null. Why?</p>
<?php var_dump( $$_POST[filterby][ $_POST['lesson_number'] ] ); ?>