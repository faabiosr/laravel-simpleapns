<?php

namespace SimpleApns;

class ValidationException extends \Exception{

	private $errors;

	public function __construct(\Laravel\Validator $container)
	{
		$this->errors = $container->errors;

		parent::__construct(null);
	}

	public function get()
	{
		return $this->errors;
	}
}