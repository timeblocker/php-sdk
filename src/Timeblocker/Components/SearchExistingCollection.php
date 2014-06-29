<?php namespace Timeblocker\Components;

use Timeblocker\Components\BaseCollection;

abstract class SearchExistingCollection extends BaseCollection {
	
	public $appointments = array();

	public $timeslots = array();

	public $appointmentsAtLocation = array();

	public function parse($response)
	{
		foreach($response as $x => $models)
		{
			if($x == 'timeslots')
			{
				$response->{$x} = new \Timeblocker\Collections\Timeslots($models);
			}
			else
			{
				$response->{$x} = new \Timeblocker\Collections\Appointments($models);
			}
		}

		$this->fill($response);

		return $this;
	}

	public function hasTimeslots()
	{
		return count($this->timeslots) > 0 ? true : false;
	}

	public function hasAppointments()
	{
		return count($this->appointments) > 0 ? true : false;
	}

	public function hasAppointmentsAtLocation()
	{
		return count($this->appointmentsAtLocation) > 0 ? true : false;
	}
}
