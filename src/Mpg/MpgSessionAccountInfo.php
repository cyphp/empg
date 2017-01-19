<?php

namespace Empg\Mpg;

class MpgSessionAccountInfo extends AbstractTransactionField
{
    protected $fieldName = 'session_account_info';
    public $sessionAccountInfoTemplate = ['policy', 'account_login', 'password_hash', 'account_number', 'account_name',
    'account_email', 'account_telephone', 'pan', 'account_address_street1', 'account_address_street2', 'account_address_city',
    'account_address_state', 'account_address_country', 'account_address_zip', 'shipping_address_street1', 'shipping_address_street2', 'shipping_address_city',
    'shipping_address_state', 'shipping_address_country', 'shipping_address_zip', 'local_attrib_1', 'local_attrib_2', 'local_attrib_3', 'local_attrib_4',
    'local_attrib_5', 'transaction_amount', 'transaction_currency',
    ];
}
