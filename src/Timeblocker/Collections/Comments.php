<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;
use Timeblocker\Components\HttpRequest;

class Comments extends BaseCollection {
	
	protected $endpoint = 'comments';

	protected $model = 'Timeblocker\Models\Comment';

	protected $fileFieldName = 'file';

	public function parse($response = array())
	{
		$class = $this->model;

		foreach($response as $index => $data)
		{
			$this->models[] = new $class($data);
		}
	}

	public static function upload($file, $fileFieldName = 'file')
	{
		$obj = new static;

		$request = new HttpRequest(array(
			'endpoint' => $obj->endpoint('read') . '/upload'
		));

		$request->addFile($fileFieldName, $file);

		return $request->post();
	}

	public static function all($parent = false)
	{
		$obj = new static;
		$obj->setQueryBuilder(static::query(array('parent' => $parent)));

		return $obj->fetch();
	}
}
