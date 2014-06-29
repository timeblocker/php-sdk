<?php namespace Timeblocker\Components;

abstract class BaseCollection {

	public $uid = null;

	public $models = array();

	protected $builder;

	protected $endpoint;

	protected $total;

	protected $perPage;

	protected $currentPage;

	protected $lastPage;

	protected $from;

	protected $to;

	protected $count;

	protected $model;

	public function __construct($data = array())
	{	
		// If response object is passed, fill the object with properties and
		// assign the models to the data array to be instantiated. 
		if(is_object($data))
		{
			$this->fill($data);

			if(isset($data->data))
			{
				$data = $data->data;
			}
		}

		// If data is array, assume it's filled with model data objects.
		if(is_array($data))
		{
			$class = $this->model;

			foreach($data as $index => $model)
			{
				$this->models[] = new $class($model);
			}
		}
	}

	public function getTotal()
	{
		return $this->total;
	}

	public function getPerPage()
	{
		return $this->perPage;
	}

	public function getCurrentPage()
	{
		return $this->currentPage;
	}

	public function getLastPage()
	{
		return $this->lastPage;
	}

	public function getFrom()
	{
		return $this->from;
	}

	public function getTo()
	{
		return $this->to;
	}

	public function setQueryBuilder(QueryBuilder $builder)
	{
		$this->builder = $builder;
	}

	public function fill($data = array())
	{
		foreach($data as $param => $value)
		{
			if(property_exists($this, $param))
			{
				$this->$param = $value;
			}
		}

		return $this;
	}

	public function first()
	{
		$models = $this->get();

		return isset($models[0]) ? $models[0] : null;
	}

	public function last()
	{		
		$models = $this->get();
		$total = $this->count() - 1;

		return isset($models[$total]) ? $models[$total] : null;
	}

	public function count()
	{
		if(!is_null($this->count))
		{
			return $this->count;
		}

		return count($this->models);
	}

	public function each($closure)
	{
		foreach($this->models as $x => $item)
		{
			$closure($item, $x);
		}
	}

	public function get()
	{
		return $this->models;
	}

	public function push($model)
	{
		array_push($this->models, $model);
	}

	public function pop($model)
	{
		array_unshift($this->models, $model);
	}

	public function getQuery()
	{
		if($this->builder)
		{
			return $this->builder->getQuery();
		}

		return array();
	}
	
	public function endpoint()
	{
		return rtrim(rtrim(str_replace(array(':uid', ':id'), $this->uid, $this->endpoint), '/'));
	}

	public function parse($response)
	{
		$class = $this->model;

		$this->fill($response);
		
		if(isset($response->data) && is_array($response->data))
		{
			foreach($response->data as $index => $model)
			{
				$this->models[] = new $class($model);
			}
		}
	}

	public function fetch()
	{
		$this->models = array();

		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint(),
			'query' => $this->getQuery()
		));

		$response = $request->get();

		$this->parse($response);

		return $this;
	}

	public function nextPage()
	{
		if($this->lastPage > $this->currentPage + 1)
		{
			$this->builder->nextPage();

			return $this->fetch();
		}

		return null;
	}

	public function prevPage()
	{
		if($this->lastPage > $this->currentPage - 1)
		{
			$this->builder->prevPage();
			
			return $this->fetch();
		}

		return null;
	}

	public function toArray()
	{
		$response = array();

		foreach($this->models as $item)
		{
			$response[] = $item->toArray();
		}

		return $response;
	}

	public static function all($query = array())
	{	
		$obj = new static;

		$builder = new QueryBuilder($obj);
		$builder->query($query);

		$obj->setQueryBuilder($builder);

		return $obj->fetch();
	}

	public static function orderBy($order, $sort = 'asc')
	{
		$obj = new static;

		$builder = new QueryBuilder($obj);
		$builder->orderBy($order, $sort);

		$obj->setQueryBuilder($builder);

		return $builder;
	}

	public static function limit($limit)
	{
		$obj = new static;

		$builder = new QueryBuilder($obj);
		$builder->limit($limit);

		$obj->setQueryBuilder($builder);

		return $builder;
	}

	public static function page($page)
	{
		$obj = new static;

		$builder = new QueryBuilder($obj);
		$builder->page($page);

		$obj->setQueryBuilder($builder);

		return $builder;
	}

	public static function query(Array $query = array())
	{
		$obj = new static;

		$builder = new QueryBuilder($obj);
		$builder->query($query);

		$obj->setQueryBuilder($builder);

		return $builder;
	}

	public static function param($param, $value)
	{
		$obj = new static;

		$builder = new QueryBuilder($obj);
		$builder->param($param, $value);

		$obj->setQueryBuilder($builder);

		return $builder;
	}

}