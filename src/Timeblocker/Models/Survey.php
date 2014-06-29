<?php namespace Timeblocker\Models;

use Timeblocker\Components\BaseModel;
use Timeblocker\Components\HttpRequest;

class Survey extends BaseModel {
	
	protected $endpoint = 'survey';

	public function questions()
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/questions'
		));

		$response = $request->get();

		return new \Timeblocker\Collections\SurveyQuestions($response);
	}

	public function fields()
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/fields'
		));

		$response = $request->get();

		return new \Timeblocker\Collections\SurveyFields($response);
	}

	public function answers()
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/answers'
		));

		$response = $request->get();

		return new \Timeblocker\Collections\AnsweredSurveys($response);
	}

	public function pending()
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/pending'
		));

		$response = $request->get();

		return new \Timeblocker\Collections\PendingSurveys($response);
	}

	public function statistics()
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/statistics'
		));

		$response = $request->get();

		return new \Timeblocker\Collections\SurveyStatistics($response);
	}

	public function send($uid)
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/send'
		));

		$response = $request->post(array(
			'profile' => $uid
		));

		return true;
	}

	public function answer(Array $data = array())
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/answer'
		));

		$response = $request->post($data);

		return new SurveyInstance($response);
	}

	public function export($file)
	{
		$request = new HttpRequest(array(
			'endpoint' => $this->endpoint('read') . '/export',
			'saveTo' => $file
		));

		$response = $request->get();
	}
}
