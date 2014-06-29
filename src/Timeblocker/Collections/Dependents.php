<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Dependents extends BaseCollection {
	
	protected $endpoint = 'client/:uid/dependents';

	protected $model = 'Timeblocker\Models\Dependent';

	public function parse($response = array())
	{
		$class = $this->model;

		foreach($response as $index => $data)
		{
			$this->models[] = new $class($data);
		}
	}

	public static function all($uid = false)
	{
		$obj = new static;

		$obj->uid = $uid;

		return $obj->fetch();
	}
}
