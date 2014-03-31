<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class AppointmentTypes extends BaseCollection {
	
	protected $endpoint = 'types';

	protected $model = 'Timeblocker\Models\AppointmentType';
}
