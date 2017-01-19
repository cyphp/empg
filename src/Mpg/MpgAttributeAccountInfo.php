<?php

namespace Empg\Mpg;

class MpgAttributeAccountInfo
{
    protected $fieldName = 'attribute_account_info';
    public $attributeAccountInfoTemplate = ['device_id', 'account_login', 'password_hash', 'account_number', 'account_name',
                                            'account_email', 'account_telephone', 'cc_number_hash', 'ip_address', 'ip_forwarded', 'account_address_street1', 'account_address_street2', 'account_address_city',
                                            'account_address_state', 'account_address_country', 'account_address_zip', 'shipping_address_street1', 'shipping_address_street2', 'shipping_address_city',
                                            'shipping_address_state', 'shipping_address_country', 'shipping_address_zip',
    ];
}
