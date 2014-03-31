<?php namespace Timeblocker\Components;

abstract class BaseModel {

	public $uid = null;

	protected $rest = array(
		'read'   => ':uid',
		'create' => '',
		'update' => ':uid',
		'delete' => ':uid'
	);

	protected $endpoint;

	protected $exclude = array();

	public function __construct($properties = array())
	{
		$this->fill($properties);
	}

	public function fill($properties = array())
	{
		if(is_array($properties) || is_object($properties))
		{
			foreach($properties as $prop => $value)
			{
				$this->$prop = $value;
			}
		}
	}

	public function endpoint($method)
	{
		$append = isset($this->rest[$method]) ? $this->rest[$method] : null;

		$endpoint = rtrim(rtrim($this->endpoint, '/') . '/' . str_replace(array(':uid', ':id'), $this->uid, $append), '/');

		return $endpoint;
	}

	public function update(Array $data = array())
	{
		$this->fill($data);

		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('update'),
			'body' => $this->properties()
		));
		
		$response = $request->put();
		
		$this->fill($response);

		return $this;
	}

	public function save(Array $data = array())
	{
		if($this->uid)
		{
			return $this->update();
		}

		$this->fill($data);

		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('create'),
			'body' => $this->properties()
		));

		$response = $request->post();
		
		$this->fill($response);

		return $this;
	}

	public function delete()
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('delete')
		));

		$response = $request->delete();
		
		$this->fill($response);

		return $this;
	}

	public function properties()
	{
		$properties = (new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PUBLIC);

		$data = array();

		foreach($properties as $prop)
		{
			if(!in_array($prop->name, $this->exclude))
			{
				$data[$prop->name] = $this->{$prop->name};
			}
		}

		return $data;
	}

	public function toArray()
	{
		return $this->properties();
	}

	public static function find($uid)
	{
		$obj = new static();
		$obj->uid = $uid;

		$request = new HttpRequest(array(
			'endpoint' => $obj->endpoint('read')
		));

		$obj->fill($request->get());

		return $obj;
	}

	public static function create(Array $data = array())
	{
		$obj = new static();

		$obj->save($data);

		return $obj;
	}
}