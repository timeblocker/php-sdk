<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class Permissions extends BaseCollection {
	
	protected $endpoint = 'permissions';

	protected $model = 'Timeblocker\Models\Permission';
}
