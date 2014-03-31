<?php namespace Timeblocker\Components;

use Timeblocker\Components\BaseModel;

class NoUidModel extends BaseModel {
	
	protected $rest = array(
		'read'   => '',
		'create' => '',
		'update' => '',
		'delete' => ''
	);

	public static function retrieve()
	{
		$obj = new static;

		$request = new HttpRequest(array(
			'endpoint' => $obj->endpoint('read')
		));

		$obj->fill($request->get());

		return $obj;
	}
}
