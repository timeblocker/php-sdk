<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class SurveyStatistics extends BaseCollection {
	
	protected $endpoint = 'survey/:uid/statistics';

	protected $model = 'Timeblocker\Models\SurveyStatistic';
}
