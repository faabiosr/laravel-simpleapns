<?php

return array(
	'local' => array(
		'host'	=> 'gateway.sandbox.push.apple.com:2195',
		'cert'	=> path('app').'certificates/dev.pem'
	),
	'prod'	=> array(
		'host'	=> 'gateway.push.apple.com:2195',
		'cert'	=> path('app').'certificates/prod.pem'	
	)
);