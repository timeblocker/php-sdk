<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class Comment extends BaseModel {
	
	protected $endpoint = 'comment';

	public function __construct($data = array())
	{
		parent::__construct($data);

		if(isset($this->profile))
		{
			$this->profile = new Profile($this->profile);
		}
	}
}
