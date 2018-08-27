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
    /**
     * @var BulkSMS
     */
    private static $service;
    private static $numbers;
    private static $dataFile = './testdata.json';

    public static function setUpBeforeClass()
    {
        $jsonData = json_decode(file_get_contents(self::$dataFile));
        self::$numbers = $jsonData->Numbers;
        self::$service = new BulkSMS($jsonData->Setting->WsUrl, $jsonData->Setting->User, $jsonData->Setting->Password, $jsonData->Setting->CpCode);
    }

    public function testGetIP()
    {
        $this->assertNotEmpty(self::$service->GetIP()->return);
    }

    public function testSendSingle()
    {
        self::$service->SetMT(new MT(7076, "message content"));
        $result = self::$service->SendSingle(self::$numbers[0]);
        var_dump($result->Response);
    }

    public function testSendMulti()
    {
        self::$service->SetMT(new MT(7076, "message content"));

        $results = self::$service->SendMulti(self::$numbers);
        $results = self::$service->SendMulti(self::$numbers);
    }
}