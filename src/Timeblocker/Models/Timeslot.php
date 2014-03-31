<?php namespace Timeblocker\Models;

use Carbon\Carbon;
use Timeblocker\Components\BaseModel;

class Timeslot extends BaseModel {
	
	protected $endpoint = 'timeslot';

	public function properties()
	{
		$properties = parent::properties();

		$properties['date'] = $this->start;

		return $properties;
	}

}
