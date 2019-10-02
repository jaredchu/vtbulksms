# Viettel bulk SMS WebService

Thư viện PHP hỗ trợ tương tác với API Bulk SMS của Viettel.

## Cài đặt
```
$ composer require jaredchu/vtbulksms:dev-master
```

## Hướng dẫn sử dụng

### Tạo object mới
```php
use JC\Viettel\WebService\BulkSMS;
use JC\Viettel\WebService\BulkSMS\MT;

$url = 'http://125.235.4.202:8998/bulkapi?wsdl';
$user = 'test';
$password = 'test';
$cpCode = 'CPCODE';
$service = new BulkSMS($url, $user, $password, $cpCode);
```
### Gửi đơn lẻ
```php
$service->SetMT(new MT(7076, "nội dung tin nhắn 1"));
$result = $service->SendSingle('0999888990');
// Kiểm tra gửi thành công hay chưa
if(!$result->IsSuccess){
  var_dump($result->Response);
}
```
### Gửi theo mảng
```php
$service->SetMT(new MT(7076, "nội dung tin nhắn 2"));
$results = $service->SendMulti(['0999888991', '0999888992', '0999888993']);
$results = $service->SendMulti(['0999888994', '0999888995', '0999888996']);
// Kiểm tra gửi thành công hay chưa
foreach ($results as $result){
  if(!$result->IsSuccess){
    var_dump($result->Response);
  }
}
```

### Kiểm tra balance
```php
$balance = $service->CheckBalance();
if($balance){
  var_dump($balance);
}
```
### Kiểm tra fail sub
```php
$failedSubs = $service->GetFailSub('alias', '30/08/2018', 1, 10);
if($failedSubs){
  var_dump($failedSubs);
}
```
