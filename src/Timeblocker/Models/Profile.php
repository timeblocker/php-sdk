<?php namespace Timeblocker\Models;

use Timeblocker\Components\NoUidModel;
use Timeblocker\Components\HttpRequest;
use Timeblocker\Models\ChangePassword;

class Profile extends NoUidModel {
	
	protected $rest = array(
		'read'   => ':uid',
		'create' => '',
		'update' => ':uid',
		'delete' => ''
	);

	protected $endpoint = 'profile';

	public function changePassword(Array $data = array())
	{
		$model = new ChangePassword($data);
		$model->update();
	}

	public function sendLoginInvite()
	{		
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('update') . '/invite'
		));

		return $request->put();
	}

}
