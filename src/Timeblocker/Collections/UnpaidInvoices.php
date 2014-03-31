<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class UnpaidInvoices extends BaseCollection {
	
	protected $endpoint = 'addon/invoices/unpaid';

	protected $model = 'Timeblocker\Models\Invoice';
}
