<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class Host extends BaseModel {
	
	protected $endpoint = 'host';

	public function properties()
	{
		$properties = parent::properties();

		if(empty($properties['fontColor']) && isset($this->settings->fontColor))
		{
			$properties['fontColor'] = $this->settings->fontColor;
		}

		if(empty($properties['backgroundColor']) && isset($this->settings->backgroundColor))
		{
			$properties['backgroundColor'] = $this->settings->backgroundColor;
		}

		if(empty($properties['private']) && isset($this->settings->private))
		{
			$properties['private'] = $this->settings->private;
		}

		return $properties;
	}

	public function createTimeslots(Array $data = array())
	{
		$data['uid'] = $this->uid;

		return Timeslot::create($data);
	}
}
