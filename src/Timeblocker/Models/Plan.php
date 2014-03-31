<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;
use Timeblocker\Models\ChangePassword;

class Plan extends BaseModel {
	
	protected $rest = array(
		'read'   => ':id',
		'create' => '',
		'update' => '',
		'delete' => ''
	);

	protected $endpoint = 'plan';
}
