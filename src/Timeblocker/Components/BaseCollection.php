<?php namespace Timeblocker\Components;

abstract class BaseCollection {

	protected $uid = null;

	protected $items = array();

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

		foreach($data as $model)
		{
			$this->items[] = new $class($model);
		}

		return $this;
	}

	public function first()
	{
		return isset($this->items[0]) ? $this->items[0] : null;
	}

	public function last()
	{		
		$total = count($this->items) - 1;

		return isset($this->items[$total]) ? $this->items[$total] : null;
	}

	public function count()
	{
		return $this->count;
	}

	public function each($closure)
	{
		foreach($this->items as $item)
		{
			$closure($item);
		}
	}

	public function push($model)
	{
		array_push($this->items, $model);
	}

	public function pop($model)
	{
		array_unshift($this->items, $model);
	}

	public function getQuery()
	{
		if($this->builder)
		{
			return $this->builder->getQuery();
		}

		return array();
	}
	
	public function endpoint($method = 'read')
	{
		return rtrim(rtrim(str_replace(array(':uid', ':id'), $this->uid, $this->endpoint), '/'));
	}

	public function fetch()
	{
		$this->items = array();

		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint(),
			'query' => $this->getQuery()
		));

		$response = $request->get();

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

		foreach($this->items as $item)
		{
			$response[] = $item->toArray();
		}

		return $response;
	}

	public static function all()
	{	
		$obj = new static;

		return $obj->fetch();
	}

	public static function orderBy($order, $sort = 'asc')
	{
		$class = get_called_class();
		$obj = new $class();

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