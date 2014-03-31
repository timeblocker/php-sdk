<?php namespace Timeblocker\Models;

use Timeblocker\Components\NoUidModel;
use Timeblocker\Components\HttpRequest;
use Timeblocker\Collections\Clients;
use Timeblocker\Models\ApiKey;

class Account extends NoUidModel {
	
	protected $endpoint = 'account';

	public function createApiKey()
	{
		return ApiKey::create();
	}

	public function settings()
	{
		return new AccountSettings($this->settings);
	}

	public function clients()
	{
		return Clients::all();
	}	
	
}