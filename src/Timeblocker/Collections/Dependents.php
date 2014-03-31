<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Dependents extends BaseCollection {
	
	protected $endpoint = 'dependents/:uid';

	protected $model = 'Timeblocker\Models\Dependent';

	public static function all($uid = false)
	{
		$obj = new static;

		$obj->uid = $uid;

		return $obj->fetch();
	}
}
