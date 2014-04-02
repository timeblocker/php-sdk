<?php namespace Timeblocker\Components;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Exception\ClientException;
use Timeblocker\Timeblocker;
use Timeblocker\Exceptions\ValidationFailedException;

class HttpRequest {

	protected $endpoint;

	protected $body = array();

	protected $query = array();

	protected $files = array();

	public function __construct($params = array())
	{
		if(is_array($params))
		{
			foreach($params as $param => $value)
			{
				$this->$param = $value;
			}
		}
	}

	public function endpoint()
	{
		return rtrim(Timeblocker::getVersion(), '/') . '/' . $this->endpoint;
	}

	public function client()
	{
		$body = $this->getBody();

		foreach($this->files as $file)
		{
			$body[$file->name] = fopen($file->path, 'r');
		}

		return new Client(array(
			'defaults' => array(
				'headers' => $this->getHeaders(),
				'query'   => $this->getQuery(),
				'body'    => $body,
			)
		));
	}

	public function get()
	{
		$client = $this->client();

		try
		{
			$response = $client->get($this->url());
		} catch(ClientException $e) {
			$response = json_decode($e->getResponse()->getBody());

		    $exception = new ValidationFailedException('Invalid Endpoint Data');
		   	$exception->setErrors((array) $response->errors);

		    throw $exception;
		}

		return $this->responseHandler($response);
	}

	public function delete()
	{
		$client = $this->client();

		try
		{		
			$response = $client->delete($this->url());
		} catch(ClientException $e) {
			$response = json_decode($e->getResponse()->getBody());

		    $exception = new ValidationFailedException('Invalid Endpoint Data');
		   	$exception->setErrors((array) $response->errors);

		    throw $exception;
		}

		return $this->responseHandler($response);
	}

	public function put()
	{
		$client = $this->client();
		
		try
		{		
			$response = $client->put($this->url());
		} catch(ClientException $e) {
			$response = json_decode($e->getResponse()->getBody());

		   	if($response)
		   	{ 
		    	$exception = new ValidationFailedException('Invalid Endpoint Data');
		   		$exception->setErrors((array) $response->errors);

		   	 	throw $exception;
		   	}
		   	else
		   	{
		   		throw $e;
		   	}
		}

		return $this->responseHandler($response);
	}

	public function post($data = array())
	{
		$client = $this->client();
		
		try
		{		
			$response = $client->post($this->url());
		} catch(ClientException $e) {
			$response = json_decode($e->getResponse()->getBody());

		    $exception = new ValidationFailedException('Invalid Endpoint Data');
		   	$exception->setErrors((array) $response->errors);

		    throw $exception;
		}

		return $this->responseHandler($response);
	}

	public function getBody()
	{
		return $this->objectToArray($this->body);
	}

	public function setBody(Array $query)
	{
		$this->body = $body;
	}

	public function getHeaders()
	{
		return array(
			'key' 	   => Timeblocker::getKey(),
			'username' => Timeblocker::getUsername(),
			'password' => Timeblocker::getPassword(),
		);
	}

	public function addFile($name, $path)
	{
   	 	$this->files[] = (object) array(
   	 		'name' => $name,
   	 		'path' => $path
   	 	);
	}

	public function setFiles(Array $files = array())
	{
   	 	$this->files = $files;
	}

	public function getFiles()
	{
   	 	return $this->files;
	}

	public function getQuery()
	{
		return $this->query;
	}

	public function setQuery(Array $query)
	{
		$this->query = $query;
	}

	public function objectToArray($obj)
	{
		if(is_object($obj))
		{
			$obj = (array) $obj;
		}

		if(is_array($obj))
		{
			$new = array();

			foreach($obj as $key => $val)
			{
				$new[$key] = $this->objectToArray($val);
			}
		}
		else 
		{
			$new = (string) $obj;
		}

		return $new;       
	}

	public function responseHandler(Response $response)
	{
		$body = json_decode($response->getBody());

		if(!isset($body->response))
		{
	    	echo((string) $response->getBody());exit();
		}

		return $body->response;
	}

	public function url($query = false)
	{	
		return Timeblocker::getProtocol() . Timeblocker::getAccount() . '.' . rtrim(Timeblocker::getDomain(), '/') . '/' . $this->endpoint();
	}
}

/*
class HttpRequest {

	protected $endpoint;
	protected $client;
	protected $body;
	protected $query = array();

	public function __construct($endpoint, $body = array(), $query = array())
	{
		$this->endpoint = $endpoint;
		$this->body = $body;
		$this->query = $query;
	}

	public function client()
	{
		return new Client(array(
			'defaults' => array(
				'headers' => $this->getHeaders(),
				'body' => $this->getBody(),
				'query' => $this->getQuery(),
			)
		));
	}

	public function getHeaders()
	{
		return array(
			'key' 	   => Timeblocker::getKey(),
			'username' => Timeblocker::getUsername(),
			'password' => Timeblocker::getPassword(),
		);
	}

	public function get($builder = false)
	{
		$this->query = $builder->getQuery();

		$response = $this->client()->get();

		return $this->responseHandler($response);
	}

	public function responseHandler(Response $response)
	{
		$body = json_decode($response->getBody());

		return $body->response;
	}

	public function objectToArray($obj)
	{
		if(is_object($obj))
		{
			$obj = (array) $obj;
		}

		if(is_array($obj))
		{
			$new = array();

			foreach($obj as $key => $val)
			{
				$new[$key] = $this->objectToArray($val);
			}
		}
		else 
		{
			$new = (string) $obj;
		}

		return $new;       
	}

	public function url($query = false)
	{	
		return Timeblocker::getProtocol() . Timeblocker::getAccount() . '.' . rtrim(Timeblocker::getDomain(), '/') . '/' . $this->endpoint();
	}

	public function endpoint()
	{
		return rtrim(Timeblocker::getVersion(), '/') . '/' . $this->endpoint;
	}
}
*/