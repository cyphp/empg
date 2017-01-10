<?php

namespace Empg\Mpg\Mc;

class McCorpal
{
    private $template = array(
            'customer_code1' => null,
            'line_item_date' => null,
            'ship_date' => null,
            'order_date' => null,
            'medical_services_ship_to_health_industry_number' => null,
            'contract_number' => null,
            'medical_services_adjustment' => null,
            'medical_services_product_number_qualifier' => null,
            'product_code1' => null,
            'item_description' => null,
            'item_quantity' => null,
            'unit_cost' => null,
            'item_unit_measure' => null,
            'ext_item_amount' => null,
            'discount_amount' => null,
            'commodity_code' => null,
            'type_of_supply' => null,
            'vat_ref_num' => null,
            'tax' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setMcCorpal($customer_code1, $line_item_date, $ship_date, $order_date, $medical_services_ship_to_health_industry_number, $contract_number, $medical_services_adjustment, $medical_services_product_number_qualifier, $product_code1, $item_description, $item_quantity, $unit_cost, $item_unit_measure, $ext_item_amount, $discount_amount, $commodity_code, $type_of_supply, $vat_ref_num, McTax $mcTax)
    {
        $this->template['customer_code1'] = $customer_code1;
        $this->template['line_item_date'] = $line_item_date;
        $this->template['ship_date'] = $ship_date;
        $this->template['order_date'] = $order_date;
        $this->template['medical_services_ship_to_health_industry_number'] = $medical_services_ship_to_health_industry_number;
        $this->template['contract_number'] = $contract_number;
        $this->template['medical_services_adjustment'] = $medical_services_adjustment;
        $this->template['medical_services_product_number_qualifier'] = $medical_services_product_number_qualifier;
        $this->template['product_code1'] = $product_code1;
        $this->template['item_description'] = $item_description;
        $this->template['item_quantity'] = $item_quantity;
        $this->template['unit_cost'] = $unit_cost;
        $this->template['item_unit_measure'] = $item_unit_measure;
        $this->template['ext_item_amount'] = $ext_item_amount;
        $this->template['discount_amount'] = $discount_amount;
        $this->template['commodity_code'] = $commodity_code;
        $this->template['type_of_supply'] = $type_of_supply;
        $this->template['vat_ref_num'] = $vat_ref_num;
        $this->template['tax'] = $mcTax->getData();

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
