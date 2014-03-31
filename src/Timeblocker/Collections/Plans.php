<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Plans extends BaseCollection {
	
	protected $endpoint = 'plans';

	protected $model = 'Timeblocker\Models\Plan';
}
