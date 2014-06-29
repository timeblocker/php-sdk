<?php namespace Timeblocker\Components;

use Carbon\Carbon;

abstract class BaseModel {

	public $uid = null;

	protected $rest = array(
		'read'   => ':uid',
		'create' => '',
		'update' => ':uid',
		'delete' => ':uid'
	);

	protected $attributes = array();

	protected $endpoint;

	protected $exclude = array();

	protected $dateProperties = array(
		'createdAt',
		'updatedAt',
		'deletedAt'
	);

	public function __set($attribute, $value)
	{
		$this->$attribute = $value;
		
		if(!in_array($attribute, $this->attributes))
		{
			$this->attributes[] = $attribute;
		}
	}

	public function __construct($attributes = array())
	{
		$this->fill($attributes);

		foreach($this->dateProperties as $property)
		{
			if(property_exists($this, $property))
			{
				$this->$property = Carbon::parse($this->$property);
			}
		}
	}

	public function fill($attributes = array())
	{
		if(is_array($attributes) || is_object($attributes))
		{
			foreach($attributes as $attribute => $value)
			{
				$this->setAttribute($attribute, $value);
			}
		}
	}

	public function setAttribute($attribute, $value)
	{
		$this->$attribute = $value;
	}

	public function getAttribute($attribute)
	{
		if(property_exists($this, $attribute))
		{
			return $this->$attribute;
		}

		return null;
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
			'body' => $this->toArray()
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
			'body' => $this->toArray()
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
		//$attributes = (new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PUBLIC);

		$data = array();

		foreach($this->attributes as $attribute)
		{
			if(!in_array($attribute, $this->exclude))
			{
				$data[$attribute] = $this->getAttribute($attribute);
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

		$obj = new static($request->get());

		return $obj;
	}

	public static function create(Array $data = array())
	{
		$obj = new static();

		$obj->save($data);

		return $obj;
	}
}