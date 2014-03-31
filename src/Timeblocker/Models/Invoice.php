<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseAddon;
use Timeblocker\Components\HttpRequest;

class Invoice extends BaseAddon {
	
	public $uid = 'invoice';

	protected $endpoint = 'addon';

	public function delete()
	{
		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/remove/' . $this->uid
		));

		return $request->delete();
	}

	public function addItem(Array $data = array())
	{
		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/' . $this->uid . '/add',
			'body' => $data
		));

		return $request->post();
	}

	public function removeItem(Array $data = array())
	{
		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/' . $this->uid . '/remove',
			'body' => $data
		));

		return $request->post();
	}

	public function pay(Array $data = array())
	{
		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/' . $this->uid . '/pay',
			'body' => $data
		));

		return $request->post();
	}

	public function paid()
	{
		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/' . $this->uid . '/paid',
		));

		return $request->post();
	}

	public function unpaid()
	{
		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/' . $this->uid . '/unpaid',
		));

		return $request->post();
	}

	public function sendReminder()
	{
		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/' . $this->uid . '/remind',
		));

		return $request->post();
	}

	public function sendReceipt()
	{
		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/' . $this->uid . '/receipt',
		));

		return $request->post();
	}

	public static function find($uid)
	{
		$obj = new static();

		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/' . $uid
		));

		$response = $request->get();

		$obj->fill($response);

		return $obj;
	}

	public static function create(Array $data = array())
	{
		$obj = new static();

		$request = new HttpRequest(array(
			'endpoint' => 'addon/invoice/create',
			'body' => $data
		));

		$response = $request->post();

		$obj->fill($response);

		return $obj;
	}
}