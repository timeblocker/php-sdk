<?php namespace Timeblocker\Collections;

use Timeblocker\Components\BaseCollection;

class TeamMembers extends BaseCollection {
	
	protected $endpoint = 'team';

	protected $model = 'Timeblocker\Models\TeamMember';
}
