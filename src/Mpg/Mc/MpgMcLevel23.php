<?php

namespace Empg\Mpg\Mc;

class MpgMcLevel23
{
    private $template = array(
            'mccorpac' => null,
            'mccorpai' => null,
            'mccorpas' => null,
            'mccorpal' => null,
            'mccorpar' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setMcCorpac(McCorpac $mcCorpac)
    {
        $this->data['mccorpac'] = $mcCorpac->getData();
    }

    public function setMcCorpai(McCorpai $mcCorpai)
    {
        $this->data['mccorpai'] = $mcCorpai->getData();
    }

    public function setMcCorpas(McCorpas $mcCorpas)
    {
        $this->data['mccorpas'] = $mcCorpas->getData();
    }

    public function setMcCorpal(McCorpal $mcCorpal)
    {
        $this->data['mccorpal'] = $mcCorpal->getData();
    }

    public function setMcCorpar(McCorpar $mcCorpar)
    {
        $this->data['mccorpar'] = $mcCorpar->getData();
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
