<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Locations extends BaseCollection {
	
	protected $endpoint = 'locations';

	protected $model = 'Timeblocker\Models\Location';
}
