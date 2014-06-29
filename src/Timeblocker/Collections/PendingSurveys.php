<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class PendingSurveys extends BaseCollection {
	
	protected $endpoint = 'survey/:uid/pending';

	protected $model = 'Timeblocker\Models\SurveyInstance';
}
