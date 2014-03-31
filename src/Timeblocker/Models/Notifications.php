<?php namespace Timeblocker\Models;

use Timeblocker\Components\NoUidModel;

class Notifications extends NoUidModel {

	protected $rest = array(
		'read'   => ':uid',
		'create' => '',
		'update' => ':uid',
		'delete' => ':uid'
	);

	protected $endpoint = 'notifications';
}
