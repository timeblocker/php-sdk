<?php namespace Timeblocker\Models;

use Timeblocker\Components\NoUidModel;
use Timeblocker\Models\Plan;

class BillingInfo extends NoUidModel {
	
	protected $endpoint = 'billing';
	
	protected $rest = array(
		'read'   => '',
		'create' => 'create',
		'update' => 'update',
		'delete' => 'cancel'
	);

	public function upgrade(Plan $plan)
	{		
		var_dump($plan);exit();
		
		$request = new HttpRequest(array(
			'endpoint' => 'upgrade/' . $plan->uid
		));

		return $request->put();
	}
}
