<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;
use Timeblocker\Collections\SearchClients;

class Clients extends BaseCollection {
	
	protected $endpoint = 'clients';

	protected $model = 'Timeblocker\Models\Client';

	public static function search($q, $limit = 20, $page = 1)
	{
		return SearchClients::param('q', $q)->limit($limit)->page($page)->get();
	}
}
