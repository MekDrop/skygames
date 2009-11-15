<?php
	require_once('../dispatcher.inc.php');

	ob_start();
	
    $Dispatcher = new Dispatcher();
    $Dispatcher->base = '/';
    $Dispatcher->dispatch('/elements/layout');
	
	$output = ob_get_contents();
	
	ob_end_clean();				
	
	echo $output;
	
 ?>	