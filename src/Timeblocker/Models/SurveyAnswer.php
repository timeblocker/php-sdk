<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class SurveyAnswer extends BaseModel {
	
	protected $endpoint = '';
	
	public function __construct($data = array())
	{
		parent::__construct($data);

		$this->question = new SurveyQuestion($this->question);
	}

}