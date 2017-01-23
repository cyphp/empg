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
        $xmlString = $this->toXML_low($this->level3template, 'cust_info');

        return $xmlString;
    }

    public function xmlSerialize(Writer $writer)
    {
        $customer = [];
        $customer = current($this->level3data['cust_info']);

        $customer['billing'] = current($this->level3data['billing']);
        $customer['shipping'] = current($this->level3data['shipping']);

        foreach ($this->level3data['item'] as $index => $item) {
            $customer[] = [
                'item' => [
                    // name is a reserved sabre/xml keyword if used without namespace
                    '{http://www.w3.org/1999/xhtml}name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'product_code' => $item['product_code'],
                    'extended_amount' => $item['extended_amount'],
                ],
            ];
        }

        $writer->write([$this->fieldName => $customer]);
    }
}
