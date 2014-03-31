<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class ApiKeys extends BaseCollection {
	
	protected $endpoint = 'keys';

	protected $model = 'Timeblocker\Models\ApiKey';
}
