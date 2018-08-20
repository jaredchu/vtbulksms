<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 20/08/2018
 * Time: 23:05
 */

namespace JC\Viettel\WebService\BulkSMS;


class MT
{
    public $UserID;
    public $ReceiverID;
    public $ServiceID;
    public $CommandCode = Enums::BULK_COMMAND_CODE;
    public $Content;
    public $ContentType;

    /**
     * MT constructor.
     * @param $UserID
     * @param $ServiceID
     * @param $Content
     * @param $ContentType
     */
    public function __construct($ServiceID, $Content, $ContentType = Enums::CONTENT_TYPE_VIETNAMESE)
    {
        $this->ServiceID = $ServiceID;
        $this->Content = $Content;
        $this->ContentType = $ContentType;
    }


}