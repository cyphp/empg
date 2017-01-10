<?php

namespace Empg\Mpg;

class MpgRecur
{
    public $params;
    public $recurTemplate = array('recur_unit', 'start_now', 'start_date', 'num_recurs', 'period', 'recur_amount');

    public function __construct($params)
    {
        $this->params = $params;
        if ((!$this->params['period'])) {
            $this->params['period'] = 1;
        }
    }

    public function toXML()
    {
        $xmlString = '';

        foreach ($this->recurTemplate as $tag) {
            $xmlString .= "<$tag>".$this->params[$tag]."</$tag>";
        }

        return "<recur>$xmlString</recur>";
    }
}//end class
