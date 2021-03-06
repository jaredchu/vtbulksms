<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 20/08/2018
 * Time: 22:30
 */

namespace JC\Viettel\WebService;


use JC\Viettel\WebService\BulkSMS\Enums;
use JC\Viettel\WebService\BulkSMS\MT;
use JC\Viettel\WebService\BulkSMS\Result;

class BulkSMS
{
    public $WsUrl;
    public $User;
    public $Password;
    public $CPCode;
    public $RequestID = Enums::REQUEST_ID_FIRST;

    protected $client;

    /**
     * @var MT
     */
    public $MT;

    /**
     * BulkSMS constructor.
     * @param $User
     * @param $Password
     * @param $CPCode
     * @param int $RequestID
     */
    public function __construct($WsUrl, $User, $Password, $CPCode)
    {
        $this->WsUrl = $WsUrl;
        $this->User = $User;
        $this->Password = $Password;
        $this->CPCode = $CPCode;

        $this->client = new \SoapClient($this->WsUrl);
    }

    public function SetMT($MT)
    {
        $this->MT = $MT;
        $this->ResetSend();
    }

    public function GetIP()
    {
        return $this->client->__soapCall(Enums::FUNCTION_GET_IP, []);
    }

    public function SendSingle($ReceiverID)
    {
        $this->MT->UserID = $this->MT->ReceiverID = $ReceiverID;

        $result = new Result($ReceiverID);
        try {
            $response = $this->client->__soapCall(Enums::FUNCTION_BULK_SMS, $this->WrapBody([
                'User' => $this->User,
                'Password' => $this->Password,
                'CPCode' => $this->CPCode,
                'RequestID' => $this->RequestID,
                'UserID' => $this->MT->UserID,
                'ReceiverID' => $this->MT->ReceiverID,
                'ServiceID' => $this->MT->ServiceID,
                'CommandCode' => $this->MT->CommandCode,
                'Content' => $this->MT->Content,
                'ContentType' => $this->MT->ContentType
            ]));

            $result->Response = $response;
            $result->IsSuccess = $result->Response->return->result == Enums::RESULT_CODE_SUCCESS;
        } catch (\Exception $ex) {
            $result->IsSuccess = false;
            $result->Error = $ex;
        }

        $this->AfterFirstSend();
        return $result;
    }

    public function CheckBalance()
    {
        try {
            $response = $this->client->__soapCall(Enums::FUNCTION_CHECK_BALANCE, $this->WrapBody([
                'User' => $this->User,
                'Password' => $this->Password,
                'CPCode' => $this->CPCode
            ]));

            if ($response->return->errCode != Enums::ERROR_CODE_CHECK_BALANCE_SUCCESS){
                return false;
            }

            return $response->return->balance;

        } catch (\Exception $ex) {
            return false;
        }
    }

    public function GetFailSub($alias, $date, $pageNumber, $pageSize){
        try {
            $response = $this->client->__soapCall(Enums::FUNCTION_GET_FAIL_SUB, $this->WrapBody([
                'username' => $this->User,
                'password' => $this->Password,
                'cpCode' => $this->CPCode,
                'alias' => $alias,
                'date' => $date,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize
            ]));

            if ($response->return->errCode != Enums::ERROR_CODE_GET_FS_SUCCESS){
                return false;
            }

            return $response->return->result;

        } catch (\Exception $ex) {
            return false;
        }
    }

    public function SendMulti($ReceiverIDs)
    {
        $results = array_map(array($this, 'SendSingle'), $ReceiverIDs);
        return $results;
    }

    public function AfterFirstSend()
    {
        if ($this->RequestID === Enums::REQUEST_ID_FIRST) {
            $this->RequestID = Enums::REQUEST_ID_AFTER_FIRST;
        }
    }

    public function ResetSend()
    {
        $this->RequestID = Enums::REQUEST_ID_FIRST;
    }

    protected function WrapBody($data)
    {
        return [
            'Body' => $data
        ];
    }
}