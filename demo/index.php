<?php

$variable_name = 'post_id';
$$variable_name = 10;

echo '$$variable_name = ';
var_dump( $$variable_name );

echo '$post_id = ';
var_dump( $post_id );