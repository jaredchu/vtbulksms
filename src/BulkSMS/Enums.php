<?php
/**
 * Created by PhpStorm.
 * User: jaredchu
 * Date: 20/08/2018
 * Time: 22:56
 */

namespace JC\Viettel\WebService\BulkSMS;


class Enums
{
    const REQUEST_ID_FIRST = 1;
    const REQUEST_ID_AFTER_FIRST = 4;
    const BULK_COMMAND_CODE = 'Bulksms';
    const CONTENT_TYPE_ENGLISH = 0;
    const CONTENT_TYPE_VIETNAMESE = 1;
}