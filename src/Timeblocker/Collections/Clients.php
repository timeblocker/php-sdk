<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;
use Timeblocker\Components\HttpRequest;
use Timeblocker\Collections\SearchClients;

class Clients extends BaseCollection {
	
	protected $endpoint = 'clients';

	protected $model = 'Timeblocker\Models\Client';

	public static function search($q, $limit = 20, $page = 1)
	{
		return SearchClients::param('q', $q)->limit($limit)->page($page)->get();
	}

	public static function export($file)
	{
		$obj = new static;

		$request = new HttpRequest(array(
			'endpoint' => $obj->endpoint('read') . '/export',
			'saveTo' => $file
		));

		$response = $request->get();		
	}
}
