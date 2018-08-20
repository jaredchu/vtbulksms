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

class BulkSMS
{
    public $WsUrl;
    public $User;
    public $Password;
    public $CPCode;
    public $RequestID = Enums::REQUEST_ID_FIRST;

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
    }

    public function SetMT($MT)
    {
        $this->MT = $MT;
    }

    public function SendSingle($ReceiverID)
    {
        $this->MT->UserID = $this->MT->ReceiverID = $ReceiverID;

        $result[$ReceiverID] = true;
        return $result;
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
}