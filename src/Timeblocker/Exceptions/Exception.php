<?php namespace Timeblocker\Exceptions;

class Exception extends \Exception {

	protected $errors = array();

	public function setErrors(Array $errors = array())
	{
		$this->errors = $errors;
	}

	public function addError($error)
	{
		$this->errors[] = $error;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}