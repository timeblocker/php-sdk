<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class ClientFields extends BaseCollection {
	
	protected $endpoint = 'fields/client';

	protected $model = 'Timeblocker\Models\ClientField';
}
