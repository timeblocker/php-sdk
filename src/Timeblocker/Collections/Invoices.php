<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Invoices extends BaseCollection {
	
	protected $endpoint = 'addon/invoices/get';

	protected $model = 'Timeblocker\Models\Invoice';
}
