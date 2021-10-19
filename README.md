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

------ Send/ Respond to a specific on demand service using link Id ------
$linkId = "link id";//The link Id of the incoming message that you received.
$response = $tm->reply_sms($linkId, $message, $apiKey);
```

## Response
The response from the above function will return a JSON string in the below format:

```php
{
    "messageId":"b77d7e8e961bc52521ca25baddab068a", //35 characters
    "status":"00",
    "statusDescription":"Success",
}
```

Below is a list of the status and their respective statusDescription returned in the above function.

- 00 - Success
- 01 - Failed
- 97 - No enough funds
- 98 - Service not found
- 99 - Missing required details

****************************************************************

## Callbacks
TaifaMobile allows customers to specify call back URLs where data is sent upon receiving from the partner Telco. This data is sent using POST method and in JSON format.

#### Delivery reports callback data
The data below will be received in JSON format whenever a delivery report is received.

```php
{
    "timestamp":"0000-00-00 00:00:00"
    "phoneNumber":"2547XXXXXXXX",
    "messageId":"b77d7e8e961bc52521ca25baddab068a",
    "status":"STATUS_MESSAGE"
}
```

#### Subscription callback data
The data below will be received in JSON format whenever a customer subscribes or unsubscribed to registered services.

```php
{
    "date":"YYYY-MM-DD HH:MM:SS",
    "phone_number":"2547XXXXXXXX",
    "service":{
        "service_name":"SERVICE_NAME",
        "keyword":"KEYWORD_USED"
    },
    "update_description":"ACTIVATION|DEACTIVATION"
}
```

#### Incoming message callback data
The data below will be received in JSON format whenever an incoming message is received.

```php
{
    "message":"Lorem Ipsum...",
    "phone_number":"2547XXXXXXXX",
    "link_id":"14101445075801587923",
    "service":{
        "service_name":"SERVICE_NAME",
        "keyword":"KEYWORD_USED"
    },
    "message_time":"0000-00-00 00:00:00"
}
```

##### Delivery reports status
Below are some of the delivery reports status (STATUS_MESSAGE) that you will receive through the API
- _DeliveredToTerminal_ : Message has been delivered									- _UserNotExist_ : Number does not exist								- _Insufficient_Balance_ : Insufficient funds at user end
- _DeliveryImpossible_ : Message has expired
- _sender_ID blacklisted by user_ : Sender ID blocked by the user
- _Invalid_Linkid_ : Incorrect link ID
- _DeliveredNotificationNotSupported_ : Notification not supported
