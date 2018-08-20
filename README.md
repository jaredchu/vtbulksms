# Viettel bulk SMS WebService

## Cài đặt
```
$ composer require jaredchu/vtbulksms:dev-master
```

## Hướng dẫn sử dụng
```php
use JC\Viettel\WebService\BulkSMS;
use JC\Viettel\WebService\BulkSMS\MT;

$url = 'http://125.235.4.202:8998/bulkapi?wsdl';
$user = 'test';
$password = 'test';
$cpCode = 'CPCODE';

$service = new BulkSMS($url, $user, $password, $cpCode);
$service->SetMT(new MT(7076, "nội dung tin nhắn 1"));
$results = $service->SendMulti(['0999888991', '0999888992', '0999888993']);
$results = $service->SendMulti(['0999888994', '0999888995', '0999888996']);

// thay thay đổi MT thì phải reset
$service->ResetSend();
$service->SetMT(new MT(7076, "nội dung tin nhắn 2"));
$results = $service->SendMulti(['0999888991', '0999888992', '0999888993']);
$results = $service->SendMulti(['0999888994', '0999888995', '0999888996']);
```
