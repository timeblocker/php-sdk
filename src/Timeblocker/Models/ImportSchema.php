<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;
use Timeblocker\Components\HttpRequest;

class ImportSchema extends BaseModel {
	
	protected $endpoint = 'schema';

	protected $fileFieldName = 'file';

	public function upload($file)
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/import'
		));

		$request->addFile($this->fileFieldName, $file);

		return $request->post();
	}

	public function toArray()
	{
		$return = parent::toArray();
		$return['suspendClients'] = $this->suspendClients == true ? 1 : 0;

		return $return;
	}
}
