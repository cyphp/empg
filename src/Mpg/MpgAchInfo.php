<?php

namespace Empg\Mpg;

class MpgAchInfo extends AbstractTransactionField
{
    protected $fieldName = 'ach_info';
    public $achTemplate = ['sec', 'cust_first_name', 'cust_last_name',
            'cust_address1', 'cust_address2', 'cust_city',
            'cust_state', 'cust_zip', 'routing_num', 'account_num',
            'check_num', 'account_type', 'micr', ];
}
