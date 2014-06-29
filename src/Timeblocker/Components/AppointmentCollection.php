<?php namespace Timeblocker\Components;

use Timeblocker\Components\BaseCollection;
use Timeblocker\Collections\Appointments;

abstract class AppointmentCollection extends BaseCollection {
	
	protected $model = 'Timeblocker\Models\Appointment';

	public function parse($response)
	{
		$class = $this->model;

		foreach($response as $index => $row)
		{
			$response[$index]->appointments = new Appointments($row->appointments);
		}

		$this->models = $response;

		return $this;
	}
}
