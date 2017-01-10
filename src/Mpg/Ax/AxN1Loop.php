<?php

namespace Empg\Mpg\Ax;

class AxN1Loop
{
    private $template = array(
            'n101' => null, 'n102' => null, 'n301' => null, 'n401' => null, 'n402' => null, 'n403' => null, 'ref' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setN1Loop($n101, $n102, $n301, $n401, $n402, $n403, AxRef $ref)
    {
        $this->template['n101'] = $n101;
        $this->template['n102'] = $n102;
        $this->template['n301'] = $n301;
        $this->template['n401'] = $n401;
        $this->template['n402'] = $n402;
        $this->template['n403'] = $n403;
        $this->template['ref'] = $ref->getData();

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
