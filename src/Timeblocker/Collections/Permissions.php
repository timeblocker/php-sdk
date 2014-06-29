<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Permissions extends BaseCollection {
	
	protected $endpoint = 'permissions';

	protected $model = 'Timeblocker\Models\Permission';
	
	public function parse($response = array())
	{
		$class = $this->model;

		foreach($response as $index => $data)
		{
			$this->models[] = new $class($data);
		}
	}
}
