<?php

namespace Empg\Mpg\Ax;

/**
 * AMEX level 23.
 */
class MpgAxLevel23
{
    private $template = array(
            'axlevel23' => array('table1' => null, 'table2' => null, 'table3' => null),
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setTable1($big04, $big05, $big10, AxN1Loop $axN1Loop)
    {
        $this->data['axlevel23']['table1']['big04'] = $big04;
        $this->data['axlevel23']['table1']['big05'] = $big05;
        $this->data['axlevel23']['table1']['big10'] = $big10;
        $this->data['axlevel23']['table1']['n1_loop'] = $axN1Loop->getData();
    }

    public function setTable2(AxIt1Loop $axIt1Loop)
    {
        $this->data['axlevel23']['table2']['it1_loop'] = $axIt1Loop->getData();
    }

    public function setTable3(AxTxi $axTxi)
    {
        $this->data['axlevel23']['table3']['txi'] = $axTxi->getData();
    }

    public function toXML()
    {
        $xmlString = $this->toXML_low($this->data, 'axlevel23');

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
