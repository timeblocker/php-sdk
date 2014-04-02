<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class ClientFields extends BaseCollection {
	
	protected $endpoint = 'fields/client';

	protected $model = 'Timeblocker\Models\ClientField';

	
	public function parse()
	{
		if(isset($response->data))
		{
			foreach($response as $param => $value)
			{
				if(property_exists($this, $param))
				{
					$this->$param = $value;
				}
			}
			
			$this->fill($response->data);
		}
		else
		{
			$this->fill($response);
		}
	}

}
