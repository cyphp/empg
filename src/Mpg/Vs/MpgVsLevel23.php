<?php

namespace Empg\Mpg\Vs;

class MpgVsLevel23
{
    private $template = array(
            'corpai' => null,
            'corpas' => null,
            'vspurcha' => null,
            'vspurchl' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setVsCorpa(VsCorpai $vsCorpai, VsCorpas $vsCorpas)
    {
        $this->data['vspurcha'] = null;
        $this->data['vspurchal'] = null;

        $this->data['corpai'] = $vsCorpai->getData();
        $this->data['corpas'] = $vsCorpas->getData();
    }

    public function setVsPurch(VsPurcha $vsPurcha, VsPurchl $vsPurchl)
    {
        $this->data['corpai'] = null;
        $this->data['corpas'] = null;

        $this->data['vspurcha'] = $vsPurcha->getData();
        $this->data['vspurchl'] = $vsPurchl->getData();
    }

    public function toXML()
    {
        $xmlString = $this->toXML_low($this->data, '0');

        return $xmlString;
    }

    private function toXML_low($dataArray, $root)
    {
        $xmlRoot = '';

        foreach ($dataArray as $key => $value) {
            if (!is_numeric($key) && $value != '' && $value != null) {
                $xmlRoot .= "<$key>";
            } elseif (is_numeric($key) && $key != '0') {
                $xmlRoot .= "</$root><$root>";
            }

            if (is_array($value)) {
                $xmlRoot .= $this->toXML_low($value, $key);
            } else {
                $xmlRoot .= $value;
            }

            if (!is_numeric($key) && $value != '' && $value != null) {
                $xmlRoot .= "</$key>";
            }
        }

        return $xmlRoot;
    }

    public function getData()
    {
        return $this->data;
    }
}
