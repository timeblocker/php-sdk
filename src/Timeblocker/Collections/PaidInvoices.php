<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class PaidInvoices extends BaseCollection {
	
	protected $endpoint = 'addon/invoices/paid';

	protected $model = 'Timeblocker\Models\Invoice';
}
