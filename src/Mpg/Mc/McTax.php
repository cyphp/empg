<?php

namespace Empg\Mpg\Mc;

class McTax
{
    private $template = array(
            'tax_amount' => null,
            'tax_rate' => null,
            'tax_type' => null,
            'tax_id' => null,
            'tax_included_in_sales' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setTax($tax_amount, $tax_rate, $tax_type, $tax_id, $tax_included_in_sales)
    {
        $this->template['tax_amount'] = $tax_amount;
        $this->template['tax_rate'] = $tax_rate;
        $this->template['tax_type'] = $tax_type;
        $this->template['tax_id'] = $tax_id;
        $this->template['tax_included_in_sales'] = $tax_included_in_sales;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
