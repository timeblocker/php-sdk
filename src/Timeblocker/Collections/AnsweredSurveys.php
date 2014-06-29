<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class AnsweredSurveys extends BaseCollection {
	
	protected $endpoint = 'survey/:uid/answers';

	protected $model = 'Timeblocker\Models\SurveyInstance';
}
