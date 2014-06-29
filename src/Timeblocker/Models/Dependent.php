<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class Dependent extends BaseModel {
	
	protected $endpoint = 'client';

	public function __construct($data = array())
	{
		parent::__construct($data);

		if($this->parent)
		{
			$this->parent = new Client($this->parent);
		}

		if($this->lastAppointment)
		{
			$this->lastAppointment = new Appointment($this->lastAppointment);
		}

		if($this->nextAppointment)
		{
			$this->nextAppointment = new Appointment($this->nextAppointment);
		}
	}
}
