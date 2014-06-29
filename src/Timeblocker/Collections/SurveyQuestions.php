<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class SurveyQuestions extends BaseCollection {
	
	protected $endpoint = 'survey/:uid/questions';

	protected $model = 'Timeblocker\Models\SurveyQuestion';
}
