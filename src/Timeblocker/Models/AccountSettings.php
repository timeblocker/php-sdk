<?php namespace Timeblocker\Models;

class AccountSettings extends Account {
	
	protected $endpoint = 'account/settings';

	protected $exclude = array('permissions');

	public function save(Array $data = array())
	{
		return $this->update($data);
	}
}
