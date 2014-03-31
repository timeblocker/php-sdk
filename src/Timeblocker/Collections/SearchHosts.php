<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class SearchHosts extends BaseCollection {
	
	protected $endpoint = 'search/hosts';

	protected $model = 'Timeblocker\Models\Host';
}
