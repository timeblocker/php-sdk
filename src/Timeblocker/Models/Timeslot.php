<?php namespace Timeblocker\Models;

use Carbon\Carbon;
use Timeblocker\Components\BaseModel;

class Timeslot extends BaseModel {
	
	protected $endpoint = 'timeslot';

	public function __construct($data = array())
	{
		parent::__construct($data);

		if(isset($this->client))
		{
			$this->client = new Client($this->client);
		}
		else
		{
			$this->client = null;
		}

		if(isset($this->host))
		{
			$this->host = new Host($this->host);
		}
		else
		{
			$this->host = null;
		}
	}

	public function properties()
	{
		$start = NULL;

		$properties = parent::properties();

		if(isset($this->start))
		{
			$start = $this->start;
		}

		$properties['date'] = $start;

		return $properties;
	}

}
