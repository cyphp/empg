<?php

namespace Empg\Mpg;

class MpgAchInfo
{
    public $params;
    public $achTemplate = array('sec', 'cust_first_name', 'cust_last_name',
            'cust_address1', 'cust_address2', 'cust_city',
            'cust_state', 'cust_zip', 'routing_num', 'account_num',
            'check_num', 'account_type', 'micr', );

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function toXML()
    {
        $xmlString = '';

        foreach ($this->achTemplate as $tag) {
            $xmlString .= "<$tag>".$this->params[$tag]."</$tag>";
        }

        return "<ach_info>$xmlString</ach_info>";
    }
}
