<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseAddon;
use Timeblocker\Components\HttpRequest;

class WhiteLabel extends BaseAddon {
	
	public $uid = 'white-label';

	protected $endpoint = 'addon';

	protected $fileFieldName = 'file';

	public function upload($file)
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/upload'
		));

		$request->addFile($this->fileFieldName, $file);

		return $request->post();
	}
}