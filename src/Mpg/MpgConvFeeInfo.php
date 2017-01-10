<?php

namespace Empg\Mpg;

class MpgConvFeeInfo
{
    public $params;
    public $convFeeTemplate = array('convenience_fee');

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function toXML()
    {
        $xmlString = '';

        foreach ($this->convFeeTemplate as $tag) {
            $xmlString .= "<$tag>".$this->params[$tag]."</$tag>";
        }

        return "<convfee_info>$xmlString</convfee_info>";
    }
}
