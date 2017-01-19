<?php

namespace Empg\Mpg;

use Sabre\Xml\XmlSerializable;
use Sabre\Xml\Writer;

abstract class AbstractTransactionField implements XmlSerializable
{
    protected $fieldName = null;
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function xmlSerialize(Writer $writer)
    {
        if (!$this->fieldName) {
            throw new \Exception('Missing transaction field name', 500);
        }

        $writer->write([
            $this->fieldName => $this->params,
        ]);
    }
}
