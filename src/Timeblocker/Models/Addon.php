<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;

class Addon extends BaseModel {
	
	protected $endpoint = 'addon';

	public function install()
	{
		return $this->save();
	}

	public function uninstall()
	{
		return $this->delete();
	}
}
