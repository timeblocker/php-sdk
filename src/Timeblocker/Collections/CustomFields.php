<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class CustomFields extends BaseCollection {

	protected $endpoint = 'custom-fields/:id';

	protected $model = 'Timeblocker\Models\CustomField';

	public function parse($response = array())
	{
		$class = $this->model;

		foreach($response as $index => $data)
		{
			$this->models[] = new $class($data);
		}
	}
}
