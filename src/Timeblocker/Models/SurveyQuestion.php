<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class SurveyQuestion extends BaseModel {
	
	protected $endpoint = 'question';

	public function __construct($data = array())
	{
		parent::__construct($data);

		if(isset($this->profile))
		{
			$this->profile = new Profile($this->profile);
		}

		if(isset($this->survey))
		{
			$this->survey = new Survey($this->survey);
		}

		if(isset($this->question))
		{
			$this->question = new SurveyQuestion($this->question);
		}
	}
	
}