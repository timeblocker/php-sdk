<?php namespace Timeblocker\Collections;

use Carbon\Carbon;
use Timeblocker\Components\BaseCollection;
use Timeblocker\Collections\SearchAppointments;
use Timeblocker\Models\AppointmentType;
use Timeblocker\Models\Availability;

class Appointments extends BaseCollection {
	
	protected $endpoint = 'search/appointments';

	protected $model = 'Timeblocker\Models\Appointment';

	public static function search($q, $limit = 20, $page = 1)
	{
		return SearchAppointments::param('q', $q)->limit($limit)->page($page)->get();
	}

	public static function availability(AppointmentType $type, Carbon $date, $limit = 20, $page = 1)
	{
		$availability = Availability::search(array(
			'type' => $type->uid,
			'date' => $date->format('Y-m-d H:i:s')
		));

		return $availability;
	}
}
