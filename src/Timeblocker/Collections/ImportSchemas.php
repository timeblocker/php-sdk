<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class ImportSchemas extends BaseCollection {
	
	protected $endpoint = 'schemas';

	protected $model = 'Timeblocker\Models\ImportSchema';
}
