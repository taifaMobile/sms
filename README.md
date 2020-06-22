# TaifaMobile SMS Application Integration

This document provides a step-by-step process of integrating Taifa Mobile PRSP System into your web application and allow you to push your SMS to a user or a group of users.

## Installation

1. Download the [TaifaMobile.php](https://github.com/taifaMobile/sms/blob/master/TaifaMobile.php) file above.
2. Copy the downloaded file into your project directory.
3. Follow the code below to send out an SMS.

## Usage

```php
require_once('PATH_TO_TAIFA_MOBILE_LIBRARY/TaifaMobile.php');

$tm = new TaifaMobile();
$message = "Lorem Ipsum is simply dummy text of the printing....";
$apiKey = "YOUR_GENERATED_API_KEY"; //Generate the API_KEY
$recepients = "07XXXXXXXX"; //Sending out single sms
$recepients = ["07XXXXXXXX", "07YYYYYYYY"]; //Sending out bulk sms

------ Send either single or multiple recepient SMS ------
$response = $tm->send_sms($recepients, $message, $apiKey);

------ Send using a specific service ------
$service_name = "SERVICE_NAME";//The name of the service to use.
$response = $tm->send_sms($recepients, $message, $apiKey, $service_name);
```

## Response
The response will either be true or false.