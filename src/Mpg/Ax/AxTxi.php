<?php

namespace Empg\Mpg\Ax;

class AxTxi
{
    private $template = array(
            'txi01' => null, 'txi02' => null, 'txi03' => null, 'txi06' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setTxi($txi01, $txi02, $txi03, $txi06)
    {
        $this->template['txi01'] = $txi01;
        $this->template['txi02'] = $txi02;
        $this->template['txi03'] = $txi03;
        $this->template['txi06'] = $txi06;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
