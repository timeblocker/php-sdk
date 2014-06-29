<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;
use Timeblocker\Components\HttpRequest;
use Timeblocker\Collections\SearchHosts;

class Hosts extends BaseCollection {
	
	protected $endpoint = 'hosts';

	protected $model = 'Timeblocker\Models\Host';

	public static function search($q, $limit = 20, $page = 1)
	{
		return SearchHosts::param('q', $q)->limit($limit)->page($page)->get();
	}
}
