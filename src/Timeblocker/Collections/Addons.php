<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Addons extends BaseCollection {
	
	protected $endpoint = 'addons';

	protected $model = 'Timeblocker\Models\Addon';
}
