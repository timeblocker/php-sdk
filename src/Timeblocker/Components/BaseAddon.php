<?php namespace Timeblocker\Components;

use Timeblocker\Components\NoUidModel;
use Timeblocker\Components\BaseAddon;
use Timeblocker\Models\Addon;

abstract class BaseAddon extends NoUidModel {

	protected $rest = array(
		'read' => ':id',
		'create' => ':id/settings',
		'update' => ':id/settings',
		'delete' => ':id/settings',
	);

	public static function install()
	{
		$obj = new static();

		$addon = new Addon();
		$addon->uid = $obj->uid;
		$addon->install();
	}

	public static function uninstall()
	{
		$obj = new static();

		$addon = new Addon();
		$addon->uid = $obj->uid;
		$addon->uninstall();
	}
}
