<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class SearchAppointments extends BaseCollection {
	
	protected $endpoint = 'search/appointments';

	protected $model = 'Timeblocker\Models\Appointment';
}
