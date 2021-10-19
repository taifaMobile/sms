<?php
class TaifaMobile
{
	public function __construct()
	{
	}

	public function send_sms($recepients, $message, $apiKey, $service_name = NULL)
	{
		$plaintext = json_encode(array("message" => $message, "recepients" => $recepients));
		$encrypted_message = $this->encrypt($plaintext, $apiKey);
		$data = ["message" => $encrypted_message, "key" => $apiKey, "service_name" => $service_name];
		$response = $this->curl_function($data, "sms");
		return $response;
	}

	public function reply_sms($linkId, $message, $apiKey)
	{
		$plaintext = json_encode(array("message" => $message, "link_id" => $linkId));
		$encrypted_message = $this->encrypt($plaintext, $apiKey);
		$data = ["message" => $encrypted_message, "key" => $apiKey];
		$response = $this->curl_function($data, "reply_sms");
		return $response;
	}

	public function encrypt($plaintext, $key, $iv = 'w4^dgd$%^62:)dgs')
	{
		$encrypted  = openssl_encrypt($plaintext, 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);
		return bin2hex($encrypted);
	}

	public function curl_function($data, $end_point)
	{
		//$url = "https://sms.taifamobile.co.ke/clientapi/" . $end_point . "/";

		$url = "http://localhost/taifa/prs/index.php/clientapi/" . $end_point . "/";
		$content = json_encode($data);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

		$json_response = curl_exec($curl);

		curl_close($curl);

		return $json_response;
	}
}
