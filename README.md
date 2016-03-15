### CAR VX SDK

## Prerequisites

 * PHP 5.4 and above
 * Curl extension with support for OpenSSL
 * Composer

## Installation

#### Install SDK via Composer
```
composer.phar require carvx/sdk
```
After installing, you need to require Composer's autoloader:
```php
require 'vendor/autoload.php';
```

#### Install SDK manually

If you don't use Composer, you can download archive with SDK from GitHub, unpack and require it in your code:
```php
require 'path-to-sdk/src/autoload.php';
```

## Usage

### Getting credentials

First of all, you should register in https://carvx.jp. Then please write an email to contact@carvx.jp with your company's name and your site's URL.
After we enable API support for your account, you will see **API Settings** section in **My Account** area of the site. There you will find credentials necessary for SDK usage.

### Making requests

You should create object of CarvxService class:
```php
$service = new Carvx\CarvxService($url, $userUid, $apiKey, $options = []);
```
where:
$url - the URL of CAR VX system - https://carvx.jp,
$userUid - user unique identifier - available in **API Settings** section of the site,
$apiKey - secret key - available in **API Settings** section of the site,
$options - optional array with parameters - see below.

#### Available options

*needSignature* - boolean - if true, all requests will be complemented with signature (based on request params and $apiKey). If false, with plain $apiKey. Default value - true. It is not recommended to set it to false (you will also need to change settings in **API Settings** section of the site).

*raiseExceptions* - boolean - if true, all exceptions occurred during request will be re-raised so you will be able to handle it manually. All exceptions are of the type of Carvx\Utils\CarvxApiException. If false, all exceptions will be handled internally. Default value - false.

*isTest* - boolean - if true, all created reports will have test type. It is useful during development and testing stage. All test reports can be found in **My Reports** section of **My Account** area of the site (with 'Test' type selected). Default value - false.
Test reports will be in completed status right after creation. So you can execute *getReport* call immediately after receiving report identifier with *createReport* call.

#### Request types

With the help of created service object you can make the following requests to CAR VX system:

1. Create search:
 ```
 $search = $service->createSearch($chassisNumber);
 ```
2. Create report:
 ```
 $reportId = $service->createReport($searchId, $carId);
 ```
3. Get report:
 ```
 $report = $service->getReport($reportId);
 ```

After you've created a report it can take for a while for it to be ready. So you can either poll the server periodically or you can set the URL in **API Settings** and you will be notified when it is ready.
