<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class SurveyFields extends BaseCollection {
	
	protected $endpoint = 'survey/:uid/fields';

	protected $model = 'Timeblocker\Models\SurveyField';
}
