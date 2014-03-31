<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Payments extends BaseCollection {
	
	protected $endpoint = 'payments';

	protected $model = 'Timeblocker\Models\Payment';
}
