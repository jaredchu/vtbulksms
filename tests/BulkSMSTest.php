<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 20/08/2018
 * Time: 22:33
 */

require(__DIR__ . '/../vendor/autoload.php');

use JC\Viettel\WebService\BulkSMS;
use JC\Viettel\WebService\BulkSMS\MT;

class BulkSMSTest extends PHPUnit_Framework_TestCase
{
    const WS_URL = 'http://125.235.4.202:8998/bulkapi?wsdl';
    const USER = 'test';
    const PASSWORD = 'test';
    const CP_CODE = 'CPCODE';

    public function testGetIP(){
        $service = new BulkSMS(self::WS_URL, self::USER, self::PASSWORD, self::CP_CODE);
        $this->assertNotEmpty($service->GetIP()->return);
    }

    public function testSendSingle()
    {
        $service = new BulkSMS(self::WS_URL, self::USER, self::PASSWORD, self::CP_CODE);
        $service->SetMT(new MT(7076, "message content"));

        $result = $service->SendSingle('0988999888');
        var_dump($result);
    }

    public function testSendMulti()
    {
        $service = new BulkSMS(self::WS_URL, self::USER, self::PASSWORD, self::CP_CODE);
        $service->SetMT(new MT(7076, "message content"));

        $results = $service->SendMulti(['0999888991', '0999888992', '0999888993']);
        $service->ResetSend();

        $results = $service->SendMulti(['0999888991', '0999888992', '0999888993']);
    }
}