<?php
namespace simpay;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Components {
	
	protected $client = '';
	
	public function __construct() {
		
		$this->client = new Client();
		
	}
	
    public function request($data, $url, $type = "params") {

		if ($type == "params") {

			$response = $this->client->request('POST', $url, [
				'form_params' => $data,
				'allow_redirects' => false,
				'connect_timeout' => 4,
				'verify' => false
			]);

		} else {

			$response = $this->client->request('POST', $url, [
				'body' => $data,
				'allow_redirects' => false,
				'connect_timeout' => 4,
				'verify' => false
			]);
			
		}

		if ($response->getStatusCode() != 200) {
			throw new RuntimeException('Response Code: ' . $response->getStatusCode());
		}
		
		return json_decode($response->getBody());
		
    }
	
    public function getRemoteAddr() {
        return getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR'[0]) ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
    }
	
	public function getIp() {
		$this->response = $this->request('', 'https://simpay.pl/api/get_ip', 'body');
		return $this->response;
	}
	
	public function checkIp($ip) {
		return in_array($ip, $this->getIp()->respond->ips);
	}

}
