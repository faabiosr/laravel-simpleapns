<?php

Autoloader::map(array(
	'SimpleApns' => Bundle::path('simpleapns').'libraries'.DIRECTORY_SEPARATOR.'SimpleApns.php',
));

Autoloader::namespaces(array(
	'SimpleApns' => Bundle::path('simpleapns').'libraries'
));