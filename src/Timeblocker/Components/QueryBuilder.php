<?php namespace Timeblocker\Components;

use Carbon\Carbon;

class QueryBuilder {

	protected $parent;

	protected $query = array();

	protected $orderBy = false;

	protected $sort = false;

	protected $limit = false;

	protected $page = 1;

	protected $class;

	public function __construct($obj)
	{
		$this->parent = $obj;
	}

	public function __toString()
	{
		return $this->queryString();
	}

	public function nextPage()
	{
		$this->page++;
	}

	public function prevPage()
	{
		$this->page--;
	}

	public function setQuery($query)
	{
		$this->query = $query;
	}

	public function getLimit()
	{
		return $this->limit;
	}

	public function getQuery()
	{
		$params = array();

		if($this->orderBy)
		{
			$params['order'] = $this->orderBy;
		}

		if($this->sort)
		{
			$params['sort'] = $this->sort;
		}

		if($this->limit)
		{
			$params['limit'] = $this->limit;
		}

		if($this->page)
		{
			$params['page'] = $this->page;
		}

		return array_merge($this->query, $params);
	}

	public function get()
	{
		return $this->parent->fetch();
	}

	public function count()
	{
		return $this->get()->count();
	}

	public function start(Carbon $date)
	{
		return $this->param('start', $date->format('Y-m-d H:i:s'));
	}

	public function end(Carbon $date)
	{
		return $this->param('end', $date->format('Y-m-d H:i:s'));
	}

	public function query(Array $params = array())
	{
		foreach($params as $param => $value)
		{
			$this->param($param, $value);
		}

		return $this;
	}

	public function param($param, $value)
	{
		$this->query[$param] = $value;

		return $this;
	}

	public function orderBy($orderBy, $sort = 'asc')
	{
		$this->orderBy = $orderBy;
		$this->sort = $sort;

		return $this;
	}

	public function page($page)
	{
		$this->page = $page;

		return $this;
	}

	public function limit($limit)
	{
		$this->limit = $limit;

		return $this;
	}
}