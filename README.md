# SimpleApns
A Apple Push Notification Service bundle for Laravel

##Instalation
=============
###Artisan
```php
php artisan bundle:install simpleapns
```
###Manually
```php
https://github.com/fabiorphp/laravel-simpleapns
```
##Bundle Registration
=====================

Add the following code to your **application/bundle.php** file:

```php
'simpleapns' => array('auto' => true),
```

##Configuration
===============
Move the **config/simpleapns.php** to the application folder and add the following to your **application/config/simpleapns.php** file:

```php
return array(
	'local' => array(
		'host'	=> 'gateway.sandbox.push.apple.com:2195',
		'cert'	=> path('app').'certificates/dev.pem',
		'pass'	=> 'OPTIONAL PASSPHRASE', // Used when generating the *.p12 file
	),
	'prod'	=> array(
		'host'	=> 'gateway.push.apple.com:2195',
		'cert'	=> path('app').'certificates/prod.pem',
		'pass'	=> 'OPTIONAL PASSPHRASE', // Used when generating the *.p12 file
	)
);
```

##Usage
=======

**Instance:**

```php
$apns = SimpleApns::make();
//or
$apns = new SimpleApns;
```

**Custom configuration:**

```php
$apns = SimpleApns::make(
	array(
		'host' => 'gateway.sandbox.push.apple.com:2195',
		'cert' => 'yourcertificate.pem',
		'pass'	=> 'OPTIONAL PASSPHRASE', // Used when generating the *.p12 file
	)
);
```

**Send a message:**

```php
try
{
	$apns->send(
		array(
			'alert' => 'Alert!',
			'badge' => '2',
			'sound' => 'default' // Not required
		),
		'device_token' // xdigits
	);
}
catch(SimpleApns\SocketException $e)
{
	echo $e->getMessage();
}
catch(SimpleApns\ValidationException $e)
{
	print_r($e->get());
}

```

Questions [@fabiorphp](http://twitter.com/fabiorphp)



