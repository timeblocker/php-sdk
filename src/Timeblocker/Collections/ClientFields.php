<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class ClientFields extends BaseCollection {
	
	protected $endpoint = 'fields/client';

	protected $model = 'Timeblocker\Models\ClientField';

	public function parse($response = array())
	{
		$class = $this->model;

		foreach($response as $index => $data)
		{
			$this->models[] = new $class($data);
		}
	}

}
