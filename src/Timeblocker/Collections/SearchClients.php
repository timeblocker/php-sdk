<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class SearchClients extends BaseCollection {
	
	protected $endpoint = 'search/clients';

	protected $model = 'Timeblocker\Models\Client';
}
