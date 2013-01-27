<?php

class SimpleApns
{

	protected static $config;

	public function __construct($config = null)
	{
		if(is_array($config))
		{
			static::$config = $config;
		}
		else
		{
			static::$config = \Laravel\Request::env() != 'local' ? \Config::get('simpleapns.prod') : \Config::get('simpleapns.local');
		}
	}

	public static function make($config = null)
	{
		return new static($config);
	}

	public static function getConfig()
	{
		return static::$config;
	}

	public static function send($payload,$deviceToken)
	{

		$validation = new SimpleApns\Validation(array(
			'alert' 		=> $payload['alert'],
			'badge' 		=> $payload['badge'],
			'device_token'	=> $deviceToken
		));

		$validation->validate();	
		
		$payload = json_encode(array('aps' => $payload));

		$streamContext = stream_context_create();
		stream_context_set_option($streamContext,'ssl','local_cert',static::$config['cert']);

		$apns = stream_socket_client('ssl://'.static::$config['host'],$nError,$sError,2,STREAM_CLIENT_CONNECT,$streamContext);

		if(!$apns)
		{
			unset($apns);
			throw new SimpleApns\SocketException($sError,$nError);
		}

		$apnsMessage = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $deviceToken)) . chr(0) . chr(strlen($payload)) . $payload;

		if(fwrite($apns,$apnsMessage))
		{
			fclose($apns);
			unset($apns);

			return TRUE;		
		}			
	}
}