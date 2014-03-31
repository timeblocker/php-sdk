<?php namespace Timeblocker\Models;

use Timeblocker\Components\NoUidModel;
use Timeblocker\Models\ChangePassword;

class ChangePassword extends NoUidModel {
	
	protected $rest = array(
		'read'   => '',
		'create' => '',
		'update' => '',
		'delete' => ''
	);

	protected $endpoint = 'password';
}
