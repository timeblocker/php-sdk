<?php namespace Timeblocker\Collections;

use Carbon\Carbon;
use Timeblocker\Components\AppointmentCollection;

class Schedule extends AppointmentCollection {

	public $type = 'day';

	public $start = false;
	
	public $end = false;

	protected $endpoint = 'schedule';

	public function __construct($params = array())
	{
		parent::__construct($params = array());

		if(!$this->start)
		{
			$this->start = Carbon::now()->startOfMonth()->format('Y-m-d');
		}

		if(!$this->end)
		{
			$this->end = Carbon::now()->endOfMonth()->format('Y-m-d');
		}
	}

	public function getQuery()
	{
		$query = parent::getQuery();

		if(!isset($query['start']))
		{
			$query['start'] = $this->start;
		}

		if(!isset($query['end']))
		{
			$query['end'] = $this->end;
		}

		return $query;
	}

	public function endpoint()
	{
		return parent::endpoint() . '/' . $this->type;
	}
}
