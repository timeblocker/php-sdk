<?php namespace Timeblocker;

use Timeblocker\Exceptions\InvalidCredentialsException;
use Timeblocker\Components\Request;

class Timeblocker {

	protected static $authToken;
	protected static $account = NULL;
	protected static $version = '1.0';
	protected static $domain = 'timeblocker.dev';
	protected static $url = 'http://{account}.{domain}/api/v{version}';

	public static function init(array $data)
	{
		foreach($data as $var => $value)
		{
			static::$$var = $value;
		}

		if(empty(static::$account))
		{
			throw new InvalidCredentialsException('Invalid Account');
		}

		/*
		if(empty(static::$username))
		{
			throw new InvalidCredentialsException('Invalid Username');
		}

		if(empty(static::$password))
		{
			throw new InvalidCredentialsException('Invalid Password');
		}

		if(empty(static::$key))
		{
			throw new InvalidCredentialsException('Invalid API Key');
		}
		*/
	}

	public static function setAccount($account)
	{
		static::$account = $account;
	}

	public static function getAccount()
	{
		return static::$account;
	}

	public static function setKey($key)
	{
		static::$key = $key;
	}

	public static function getKey()
	{
		return static::$key;
	}

	public static function setUsername($username)
	{
		static::$username = $username;
	}

	public static function getUsername()
	{
		return static::$username;
	}

	public static function setPassword($password)
	{
		static::$password = $password;
	}

	public static function getPassword()
	{
		return static::$password;
	}

	public static function setVersion($version)
	{
		static::$version = $version;
	}

	public static function getVersion()
	{
		return static::$version;
	}

	public static function setProtocol($protocol)
	{
		static::$protocol = $protocol;
	}

	public static function getProtocol()
	{
		return static::$protocol;
	}

	public static function setDomain($domain)
	{
		static::$domain = $domain;
	}

	public static function getDomain()
	{
		return static::$domain;
	}

	public static function setAuthToken($token)
	{
		static::$authToken = $token;
	}

	public static function getAuthToken()
	{
		return static::$authToken;
	}

	public static function setApiUrl($url)
	{
		static::$url = $url;
	}

	public static function getApiUrl()
	{
		if(is_null(static::getAccount()))
		{
			throw new NoAccountSetException();
		}

		$return = str_replace('{account}', static::getAccount(), static::$url);
		$return = str_replace('{version}', static::getVersion(), $return);
		$return = str_replace('{domain}', static::getDomain(), $return);

		return $return;
	}

	/*
	public static function attempt(array $data = array())
	{
		if(count($data))
		{
			static::auth($data);
		}

		$request = new Request();
	}
	*/
}