<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class ApiKey extends BaseModel {
	
	protected $endpoint = 'key';

	public function __construct($response = array())
	{
		parent::__construct($response);

		$this->uid = $this->key;
	}
}