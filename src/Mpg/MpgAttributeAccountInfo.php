<?php

namespace Empg\Mpg;

class MpgAttributeAccountInfo
{
    public $params;
    public $attributeAccountInfoTemplate = array('device_id', 'account_login', 'password_hash', 'account_number', 'account_name',
                                            'account_email', 'account_telephone', 'cc_number_hash', 'ip_address', 'ip_forwarded', 'account_address_street1', 'account_address_street2', 'account_address_city',
                                            'account_address_state', 'account_address_country', 'account_address_zip', 'shipping_address_street1', 'shipping_address_street2', 'shipping_address_city',
                                            'shipping_address_state', 'shipping_address_country', 'shipping_address_zip',
    );

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function toXML()
    {
        $xmlString = '';
        foreach ($this->attributeAccountInfoTemplate as $tag) {
            if (isset($this->params[$tag])) {
                $xmlString .= "<$tag>".$this->params[$tag]."</$tag>";
            }
        }

        return "<attribute_account_info>$xmlString</attribute_account_info>";
    }
}
