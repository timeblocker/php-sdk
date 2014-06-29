<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class Location extends BaseModel {
	
	protected $endpoint = 'location';

	public function __construct($properties = array())
	{
		parent::__construct($properties);

		$this->hosts = new \Timeblocker\Collections\Hosts($this->hosts);
	}
}
