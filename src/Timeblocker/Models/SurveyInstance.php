<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;
use Timeblocker\Components\HttpRequest;
use Timeblocker\Collections\SurveyAnswers;

class SurveyInstance extends BaseModel {
	
	protected $endpoint = 'survey-instance';

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

		if(isset($this->answers))
		{
			$this->answers = new SurveyAnswers($this->answers);
		}
	}

	public function isAnswered()
	{
		return (int) $this->answered == 1;
	}
}