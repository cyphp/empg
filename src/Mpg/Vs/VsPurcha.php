<?php

namespace Empg\Mpg\Vs;

class VsPurcha
{
    private $template = array(
            'buyer_name' => null,
            'local_tax_rate' => null,
            'duty_amount' => null,
            'discount_treatment' => null,
            'discount_amt' => null,
            'freight_amount' => null,
            'ship_to_pos_code' => null,
            'ship_from_pos_code' => null,
            'des_cou_code' => null,
            'vat_ref_num' => null,
            'tax_treatment' => null,
            'gst_hst_freight_amount' => null,
            'gst_hst_freight_rate' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setVsPurcha($buyer_name, $local_tax_rate, $duty_amount, $discount_treatment, $discount_amt, $freight_amount, $ship_to_pos_code, $ship_from_pos_code, $des_cou_code, $vat_ref_num, $tax_treatment, $gst_hst_freight_amount, $gst_hst_freight_rate)
    {
        $this->data['buyer_name'] = $buyer_name;
        $this->data['local_tax_rate'] = $local_tax_rate;
        $this->data['duty_amount'] = $duty_amount;
        $this->data['discount_treatment'] = $discount_treatment;
        $this->data['discount_amt'] = $discount_amt;
        $this->data['freight_amount'] = $freight_amount;
        $this->data['ship_to_pos_code'] = $ship_to_pos_code;
        $this->data['ship_from_pos_code'] = $ship_from_pos_code;
        $this->data['des_cou_code'] = $des_cou_code;
        $this->data['vat_ref_num'] = $vat_ref_num;
        $this->data['tax_treatment'] = $tax_treatment;
        $this->data['gst_hst_freight_amount'] = $gst_hst_freight_amount;
        $this->data['gst_hst_freight_rate'] = $gst_hst_freight_rate;
    }

    public function setBuyerName($buyer_name)
    {
        $this->data['buyer_name'] = $buyer_name;
    }

    public function setLocalTaxRate($local_tax_rate)
    {
        $this->data['local_tax_rate'] = $local_tax_rate;
    }

    public function setDutyAmount($duty_amount)
    {
        $this->data['duty_amount'] = $duty_amount;
    }

    public function setDiscountTreatment($discount_treatment)
    {
        $this->data['discount_treatment'] = $discount_treatment;
    }

    public function setDiscountAmt($discount_amt)
    {
        $this->data['discount_amt'] = $discount_amt;
    }

    public function setFreightAmount($freight_amount)
    {
        $this->data['freight_amount'] = $freight_amount;
    }

    public function setShipToPostalCode($ship_to_pos_code)
    {
        $this->data['ship_to_pos_code'] = $ship_to_pos_code;
    }

    public function setShipFromPostalCode($ship_from_pos_code)
    {
        $this->data['ship_from_pos_code'] = $ship_from_pos_code;
    }

    public function setDesCouCode($des_cou_code)
    {
        $this->data['des_cou_code'] = $des_cou_code;
    }

    public function setVatRefNum($vat_ref_num)
    {
        $this->data['vat_ref_num'] = $vat_ref_num;
    }

    public function setTaxTreatment($tax_treatment)
    {
        $this->data['tax_treatment'] = $tax_treatment;
    }

    public function setGstHstFreightAmount($gst_hst_freight_amount)
    {
        $this->data['gst_hst_freight_amount'] = $gst_hst_freight_amount;
    }

    public function setGstHstFreightRate($gst_hst_freight_rate)
    {
        $this->data['gst_hst_freight_rate'] = $gst_hst_freight_rate;
    }

    public function getData()
    {
        return $this->data;
    }
}
