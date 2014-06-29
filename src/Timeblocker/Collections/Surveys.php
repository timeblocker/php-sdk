<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Surveys extends BaseCollection {
	
	protected $endpoint = 'surveys';

	protected $model = 'Timeblocker\Models\Survey';
}
