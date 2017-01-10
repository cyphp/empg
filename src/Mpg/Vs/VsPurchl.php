<?php

namespace Empg\Mpg\Vs;

class VsPurchl
{
    private $template = array(
            'item_com_code' => null,
            'product_code' => null,
            'item_description' => null,
            'item_quantity' => null,
            'item_uom' => null,
            'unit_cost' => null,
            'vat_tax_amt' => null,
            'vat_tax_rate' => null,
            'discount_treatment' => null,
            'discount_amt' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setVsPurchl($item_com_code, $product_code, $item_description, $item_quantity, $item_uom, $unit_cost, $vat_tax_amt, $vat_tax_rate, $discount_treatment, $discount_amt)
    {
        $this->template['item_com_code'] = $item_com_code;
        $this->template['product_code'] = $product_code;
        $this->template['item_description'] = $item_description;
        $this->template['item_quantity'] = $item_quantity;
        $this->template['item_uom'] = $item_uom;
        $this->template['unit_cost'] = $unit_cost;
        $this->template['vat_tax_amt'] = $vat_tax_amt;
        $this->template['vat_tax_rate'] = $vat_tax_rate;
        $this->template['discount_treatment'] = $discount_treatment;
        $this->template['discount_amt'] = $discount_amt;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
