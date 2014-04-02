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
		if(count($data))
		{
			$this->fill($data);
		}

		if(count($this->models))
		{
			$class = $this->model;

			foreach($this->models as $index => $model)
			{
				$this->models[$index] = new $class($model);
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

	public function fill(Array $data = array())
	{
		$class = $this->model;

		foreach($data as $index => $value)
		{
			if($index == 'models')
			{
				foreach($value as $model)
				{
					$this->models[] = new $class($model);
				}
			}
			else
			{
				$this->$index = $value;
			}
		}

		return $this;
	}

	public function first()
	{
		return isset($this->models[0]) ? $this->models[0] : null;
	}

	public function last()
	{		
		$total = count($this->models) - 1;

		return isset($this->models[$total]) ? $this->models[$total] : null;
	}

	public function count()
	{
		return $this->count;
	}

	public function each($closure)
	{
		foreach($this->models as $item)
		{
			$closure($item);
		}
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
		if(isset($response->data))
		{
			foreach($response as $param => $value)
			{
				if(property_exists($this, $param))
				{
					$this->$param = $value;
				}
			}
			
			$this->fill($response->data);
		}
		else
		{
			$this->fill($response);
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

	public static function all(Array $query = array())
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

	/*
	public static function param($param, $value)
	{
		$builder = new QueryBuilder(get_called_class());
		$builder->param($param, $value);

		return $builder;
	}



	public static function page($page)
	{
		$builder = new QueryBuilder();
		$builder->page($page);

		return $builder;
	}

	public static function param($param, $value)
	{
		$builder = new QueryBuilder();
		$builder->param($param, $value);

		return $builder;
	}

	public static function param($param, $value)
	{
		$builder = new QueryBuilder(get_called_class());
		$builder->param($param, $value);

		return $builder;
	}
	*/

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