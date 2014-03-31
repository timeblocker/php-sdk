<?php namespace Timeblocker;

use Timeblocker\Exceptions\InvalidCredentialsException;
use Timeblocker\Components\Request;

class Timeblocker {

	protected static $account;
	protected static $username;
	protected static $password;
	protected static $key;
	protected static $version = 'v1';
	protected static $protocol = 'https://';
	protected static $domain = 'timeblocker.co/api';

	public static function auth(array $data)
	{
		foreach($data as $var => $value)
		{
			self::$$var = $value;
		}

		if(empty(self::$account))
		{
			throw new InvalidCredentialsException('Invalid Account');
		}

		if(empty(self::$username))
		{
			throw new InvalidCredentialsException('Invalid Username');
		}

		if(empty(self::$password))
		{
			throw new InvalidCredentialsException('Invalid Password');
		}

		if(empty(self::$key))
		{
			throw new InvalidCredentialsException('Invalid API Key');
		}
	}

	public static function setAccount($account)
	{
		self::$account = $account;
	}

	public static function getAccount()
	{
		return self::$account;
	}

	public static function setKey($key)
	{
		self::$key = $key;
	}

	public static function getKey()
	{
		return self::$key;
	}

	public static function setUsername($username)
	{
		self::$username = $username;
	}

	public static function getUsername()
	{
		return self::$username;
	}

	public static function setPassword($password)
	{
		self::$password = $password;
	}

	public static function getPassword()
	{
		return self::$password;
	}

	public static function setVersion($version)
	{
		self::$version = $version;
	}

	public static function getVersion()
	{
		return self::$version;
	}

	public static function setProtocol($protocol)
	{
		self::$protocol = $protocol;
	}

	public static function getProtocol()
	{
		return self::$protocol;
	}

	public static function setDomain($domain)
	{
		self::$domain = $domain;
	}

	public static function getDomain()
	{
		return self::$domain;
	}

	/*
	public static function attempt(array $data = array())
	{
		if(count($data))
		{
			self::auth($data);
		}

		$request = new Request();
	}
	*/
}