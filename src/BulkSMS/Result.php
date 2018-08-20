<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 21/08/2018
 * Time: 00:38
 */

namespace JC\Viettel\WebService\BulkSMS;


class Result
{
    public $ReceiverID;
    public $IsSuccess;
    public $ErrorCode;
    public $ErrorMessage;
    public $response;

    /**
     * Result constructor.
     * @param $ReceiverID
     */
    public function __construct($ReceiverID)
    {
        $this->ReceiverID = $ReceiverID;
    }
}