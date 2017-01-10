<?php

namespace Empg\Mpg;

class MpgCustInfo
{
    public $level3template = array(
            'cust_info' => array('email', 'instructions',
                                 'billing' => array('first_name', 'last_name', 'company_name', 'address',
                                                     'city', 'province', 'postal_code', 'country',
                                                     'phone_number', 'fax', 'tax1', 'tax2', 'tax3',
                                                     'shipping_cost', ),
                                 'shipping' => array('first_name', 'last_name', 'company_name', 'address',
                                                     'city', 'province', 'postal_code', 'country',
                                                     'phone_number', 'fax', 'tax1', 'tax2', 'tax3',
                                                     'shipping_cost', ),
                                 'item' => array('name', 'quantity', 'product_code', 'extended_amount'),
        ),
    );

    public $level3data;
    public $email;
    public $instructions;

    public function __construct($custinfo = 0, $billing = 0, $shipping = 0, $items = 0)
    {
        if ($custinfo) {
            $this->setCustInfo($custinfo);
        }
    }

    public function setCustInfo($custinfo)
    {
        $this->level3data['cust_info'] = array($custinfo);
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->setCustInfo(array('email' => $email, 'instructions' => $this->instructions));
    }

    public function setInstructions($instructions)
    {
        $this->instructions = $instructions;

        $this->setCustinfo(array('email' => $this->email, 'instructions' => $instructions));
    }

    public function setShipping($shipping)
    {
        $this->level3data['shipping'] = array($shipping);
    }

    public function setBilling($billing)
    {
        $this->level3data['billing'] = array($billing);
    }

    public function setItems($items)
    {
        if (!isset($this->level3data['item'])) {
            $this->level3data['item'] = array($items);
        } else {
            $index = count($this->level3data['item']);
            $this->level3data['item'][$index] = $items;
        }
    }

    public function toXML()
    {
        $xmlString = $this->toXML_low($this->level3template, 'cust_info');

        return $xmlString;
    }

    public function toXML_low($template, $txnType)
    {
        $xmlString = '';
        for ($x = 0; $x < count($this->level3data[$txnType]); ++$x) {
            if ($x > 0) {
                $xmlString .= "</$txnType><$txnType>";
            }

            $keys = array_keys($template);

            for ($i = 0; $i < count($keys); ++$i) {
                $tag = $keys[$i];

                if (is_array($template[$keys[$i]])) {
                    $data = $template[$tag];

                    if (!count($this->level3data[$tag])) {
                        continue;
                    }
                    $beginTag = "<$tag>";
                    $endTag = "</$tag>";

                    $xmlString .= $beginTag;

                  #if(is_array($data))
                   {
                    $returnString = $this->toXML_low($data, $tag);
                    $xmlString .= $returnString;
                   }
                    $xmlString .= $endTag;
                } else {
                    $tag = $template[$keys[$i]];
                    $beginTag = "<$tag>";
                    $endTag = "</$tag>";
                    $data = $this->level3data[$txnType][$x][$tag];
                    $xmlString .= $beginTag.$data.$endTag;
                }
            }//end inner for
        }//end outer for

        return $xmlString;
    }
}
