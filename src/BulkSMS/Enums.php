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

    const FUNCTION_GET_IP = 'getIp';
    const FUNCTION_BULK_SMS = 'wsCpMt';
    const FUNCTION_CHECK_BALANCE = 'checkBalance';
    const FUNCTION_GET_FAIL_SUB = 'getFailSub';
    const FUNCTION_GET_CP_CODE = 'wsGetCpCode';

    const ERROR_CODE_CHECK_BALANCE_SUCCESS = 0;
    const ERROR_CODE_GET_FS_SUCCESS = 1;
    const RESULT_CODE_SUCCESS = 1;
}