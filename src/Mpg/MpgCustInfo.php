<?php

namespace Empg\Mpg;

use Sabre\Xml\XmlSerializable;
use Sabre\Xml\Writer;

class MpgCustInfo implements XmlSerializable
{
    protected $fieldName = 'cust_info';
    protected $format = [
        'cust_info' => [
            'email',
            'instructions',
            'billing' => ['first_name', 'last_name', 'company_name', 'address',
                             'city', 'province', 'postal_code', 'country',
                             'phone_number', 'fax', 'tax1', 'tax2', 'tax3',
                             'shipping_cost', ],
            'shipping' => ['first_name', 'last_name', 'company_name', 'address',
                             'city', 'province', 'postal_code', 'country',
                             'phone_number', 'fax', 'tax1', 'tax2', 'tax3',
                             'shipping_cost', ],
            'item' => ['name', 'quantity', 'product_code', 'extended_amount'],
        ],
    ];

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
            $this->level3data['item'] = [];
        }

        $this->level3data['item'][] = $items;
    }

    public function toXML()
    {
        dump($this->level3data);
        $xmlString = $this->toXML_low($this->level3template, 'cust_info');

        return $xmlString;
    }

    public function xmlSerialize(Writer $writer)
    {
        $customer = current($this->level3data['cust_info']);

        $customer['billing'] = $this->level3data['billing'];
        $customer['shipping'] = $this->level3data['shipping'];
        
        foreach ($this->level3data['item'] as $index => $item) {
            $customer[] = [
                'item' => json_decode(json_encode($item), true),
            ];
        }

        $writer->write([$this->fieldName => $customer]);
    }

    // public function toXML_low($template, $txnType)
    // {
    //     $xmlString = '';
    //     for ($x = 0; $x < count($this->level3data[$txnType]); ++$x) {
    //         if ($x > 0) {
    //             $xmlString .= "</$txnType><$txnType>";
    //         }

    //         $keys = array_keys($template);

    //         // for ($i = 0; $i < count($keys); ++$i) {
    //         foreach ($keys as $i => $tag) {
    //             // dump('inner foreach '.$i.' '.$tag);
    //             if (is_array($template[$tag])) {
    //                 $data = $template[$tag];

    //                 if (!count($this->level3data[$tag])) {
    //                     continue;
    //                 }
    //                 // dump("is_array: ".$tag);

    //                 $xmlString .="<$tag>";
    //                 $xmlString .= $this->toXML_low($data, $tag);
    //                 $xmlString .= "</$tag>";
    //             } else {
    //                 $tag = $template[$keys[$i]];
    //                 // dump("not is array: ".$tag);
    //                 $beginTag = "<$tag>";
    //                 $endTag = "</$tag>";
    //                 $data = $this->level3data[$txnType][$x][$tag];
    //                 $xmlString .= $beginTag.$data.$endTag;
    //             }
    //         }//end inner for
    //     }//end outer for

    //     return $xmlString;
    // }
}
