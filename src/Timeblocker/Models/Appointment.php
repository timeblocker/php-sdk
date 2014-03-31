<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;
use Timeblocker\Components\HttpRequest;

class Appointment extends BaseModel {
	
	protected $endpoint = 'appointment';

	public function confirm()
	{		
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('update') . '/confirm'
		));

		$response = $request->put();

		$this->fill($response);

		return $this;
	}

	public function unconfirm()
	{		
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('update') . '/unconfirm'
		));

		$response = $request->put();

		$this->fill($response);

		return $this;
	}

	public function sendConfirmation()
	{		
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('update') . '/confirmation'
		));

		$response = $request->put();

		$this->fill($response);

		return $this;
	}

	public function sendReminder()
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('update') . '/reminder'
		));

		$response = $request->put();

		$this->fill($response);

		return $this;
	}

	public function createInvoice()
	{
		return Invoice::create(array(
			'client' => $this->client->uid,
			'appointment' => $this->uid
		));
	}
}
