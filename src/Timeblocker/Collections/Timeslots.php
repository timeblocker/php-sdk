<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;
use Timeblocker\Components\QueryBuilder;
use Carbon\Carbon;

class Timeslots extends BaseCollection {
	
	protected $endpoint = 'timeslots';

	protected $model = 'Timeblocker\Models\Timeslot';

	public static function range(Carbon $start, Carbon $end)
	{
		$obj = new static;

		$builder = new QueryBuilder($obj);
		$builder->param('start', $start->format('Y-m-d H:i:s'));
		$builder->param('end', $end->format('Y-m-d H:i:s'));

		$obj->setQueryBuilder($builder);

		return $builder;
	}

	public static function start(Carbon $date)
	{
		$obj = new static;

		$builder = new QueryBuilder($obj);
		$builder->param('start', $date->format('Y-m-d H:i:s'));

		$obj->setQueryBuilder($builder);

		return $builder;
	}

	public static function end(Carbon $date)
	{
		$obj = new static;

		$builder = new QueryBuilder($obj);
		$builder->param('end', $date->format('Y-m-d H:i:s'));

		$obj->setQueryBuilder($builder);

		return $builder;
	}
}
