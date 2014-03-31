<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;
use Timeblocker\Components\HttpRequest;
use Timeblocker\Collections\Dependents;
use Timeblocker\Models\Invoice;

class Client extends BaseModel {
	
	protected $endpoint = 'client';

	public function dependents()
	{
		return Dependents::all($this->uid);
	}

	public function createDependent(Array $data = array())
	{
		$data['parent'] = $this->uid;

		return Client::create($data);
	}

	public function suspend()
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('update') . '/suspend',
			'body' => array()
		));

		$response = $request->put();

		$this->fill($response);

		return $this;
	}

	public function unsuspend()
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('update') . '/unsuspend',
			'body' => array()
		));

		$response = $request->put();

		$this->fill($response);

		return $this;
	}

	public function createInvoice()
	{
		return Invoice::create(array(
			'client' => $this->uid
		));
	}
}
