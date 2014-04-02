<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class CustomField extends BaseModel {
	
	protected $rest = array(
		'read' => ':id',
		'create' => '',
		'update' => '',
		'delete' => ''
	);

	protected $endpoint = 'custom-field';
}
