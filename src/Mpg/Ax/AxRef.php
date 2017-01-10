<?php

namespace Empg\Mpg\Ax;

class AxRef
{
    private $template = array(
            'ref01' => null, 'ref02' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setRef($ref01, $ref02)
    {
        $this->template['ref01'] = $ref01;
        $this->template['ref02'] = $ref02;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
