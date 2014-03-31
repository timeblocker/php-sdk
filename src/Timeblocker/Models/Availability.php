<?php namespace Timeblocker\Models;

use Timeblocker\Components\HttpRequest;
use Timeblocker\Components\NoUidModel;

class Availability extends NoUidModel {
	
	protected $endpoint = 'search/availability';

	public static function search($data = array())
	{
		$obj = new static;

		$request = new HttpRequest(array(
			'endpoint' => $obj->endpoint('read'),
			'query' => $data
		));

		$obj->fill($request->get());

		return $obj;
	}
}
