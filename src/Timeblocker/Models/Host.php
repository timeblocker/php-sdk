<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class Host extends BaseModel {
	
	protected $endpoint = 'host';

	public function properties()
	{
		$properties = parent::properties();

		if(empty($properties['fontColor']))
		{
			$properties['fontColor'] = $this->settings->fontColor;
		}

		if(empty($properties['backgroundColor']))
		{
			$properties['backgroundColor'] = $this->settings->backgroundColor;
		}

		return $properties;
	}

	public function createTimeslots(Array $data = array())
	{
		$data['uid'] = $this->uid;

		return Timeslot::create($data);
	}
}
