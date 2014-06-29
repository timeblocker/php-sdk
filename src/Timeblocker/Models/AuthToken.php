<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;
use Timeblocker\Components\HttpRequest;

class AuthToken extends BaseModel {
	
	protected $endpoint = 'auth';

	public static function login(Array $data = array())
	{	
		$obj = new static;

		$request = new HttpRequest(array(
			'endpoint' => $obj->endpoint('create') . '/login'
		));

		$response = $request->post($data);

		$obj->fill($response);

		return $obj;
	}

	public static function logout($token)
	{	
		$obj = new static;

		$request = new HttpRequest(array(
			'endpoint' => $obj->endpoint('create') . '/' . $token . '/logout'
		));

		$response = $request->post();

		return $response;
	}

	public static function reset($email)
	{
		$obj = new static;

		$request = new HttpRequest(array(
			'endpoint' => $obj->endpoint('create') . '/reset'
		));

		return $request->post(array('email' => $email));
	}
}
