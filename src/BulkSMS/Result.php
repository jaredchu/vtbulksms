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
    /**
     * @var bool
     */
    public $IsSuccess;
    /**
     * @var \Error
     */
    public $Error;
    public $Response;

    /**
     * Result constructor.
     * @param $ReceiverID
     */
    public function __construct($ReceiverID)
    {
        $this->ReceiverID = $ReceiverID;
    }
}