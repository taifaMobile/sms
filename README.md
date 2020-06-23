# TaifaMobile SMS Application Integration

This document provides a step-by-step process of integrating Taifa Mobile PRSP System into your web application and allow you to push your SMS to a user or a group of users.

## Installation
TaifaMobile SMS library will require CURL for it to send data to the server. Please ensure you have it installed. After installing CURL, follow the below steps;

1. Download the [TaifaMobile.php](https://github.com/taifaMobile/sms/blob/master/TaifaMobile.php) file.
2. Copy the downloaded file into your project directory.
3. Follow the code below and make necessary changes to send out an SMS.

## Usage

```php
require_once('PATH_TO_TAIFA_MOBILE_LIBRARY/TaifaMobile.php');

$tm = new TaifaMobile();
$message = "Lorem Ipsum is simply dummy text of the printing....";
//Generate the APIKey from the webapp > Settings > APIKey.
//Your API Key is private and confidential
$apiKey = "YOUR_GENERATED_API_KEY"; //Generate the API_KEY
$recepients = "07XXXXXXXX"; //Sending out single sms
$recepients = ["07XXXXXXXX", "07YYYYYYYY"]; //Sending out bulk sms

//------ Send either single or multiple recepient SMS ------
$response = $tm->send_sms($recepients, $message, $apiKey);

//------ Send using a specific service ------
$service_name = "SERVICE_NAME";//The name of the service to use.
$response = $tm->send_sms($recepients, $message, $apiKey, $service_name);
```

## Response
The server will return one of the below responses:
- 00 - Success
- 01 - Failed
- 97 - No enough funds
- 98 - Service not found
- 99 - Missing required details