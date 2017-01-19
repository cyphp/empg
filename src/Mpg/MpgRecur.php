<?php

namespace Empg\Mpg;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class MpgRecur implements XmlSerializable
{
    public $params;
    public $recurTemplate = ['recur_unit', 'start_now', 'start_date', 'num_recurs', 'period', 'recur_amount'];

    public function __construct($params)
    {
        $this->params = $params;
        if ((!$this->params['period'])) {
            $this->params['period'] = 1;
        }
    }

    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            'recur' => $this->params,
        ]);
    }
}
