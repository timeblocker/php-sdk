<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;
use Timeblocker\Collections\SurveyStatisticDataset;

class SurveyStatistic extends BaseModel {
	
	protected $endpoint = 'survey/:uid/statistics';

	public function __construct($data = array())
	{
		parent::__construct($data);

		$this->question = new SurveyQuestion($this->question);	
		$this->statistics = new SurveyStatisticDataset($this->statistics);	
	}
}