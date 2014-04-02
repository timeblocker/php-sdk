<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class CustomFields extends BaseCollection {

	protected $endpoint = 'custom-fields/:id';

	protected $model = 'Timeblocker\Models\CustomField';
}
