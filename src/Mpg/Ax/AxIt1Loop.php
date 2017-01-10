<?php

namespace Empg\Mpg\Ax;

class AxIt1Loop
{
    private $template = array(
            'it102' => null, 'it103' => null, 'it104' => null, 'it105' => null, 'it106s' => null, 'txi' => null, 'pam05' => null, 'pid05' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setIt1Loop($it102, $it103, $it104, $it105, AxIt106s $it106s, AxTxi $txi, $pam05, $pid05)
    {
        $this->template['it102'] = $it102;
        $this->template['it103'] = $it103;
        $this->template['it104'] = $it104;
        $this->template['it105'] = $it105;
        $this->template['it106s'] = $it106s->getData();
        $this->template['txi'] = $txi->getData();
        $this->template['pam05'] = $pam05;
        $this->template['pid05'] = $pid05;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
