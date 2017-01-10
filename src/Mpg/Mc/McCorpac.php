<?php

namespace Empg\Mpg\Mc;

class McCorpac
{
    private $template = array(
            'customer_code1' => null,
            'additional_card_acceptor_data' => null,
            'austin_tetra_number' => null,
            'naics_code' => null,
            'card_acceptor_type' => null,
            'card_acceptor_tax_id' => null,
            'corporation_vat_number' => null,
            'card_acceptor_reference_number' => null,
            'freight_amount1' => null,
            'duty_amount1' => null,
            'ship_to_pos_code' => null,
            'destination_province_code' => null,
            'destination_country_code' => null,
            'ship_from_pos_code' => null,
            'order_date' => null,
            'card_acceptor_vat_number' => null,
            'customer_vat_number' => null,
            'unique_invoice_number' => null,
            'commodity_code' => null,
            'authorized_contact_name' => null,
            'authorized_contact_phone' => null,
            'tax' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setMcCorpac($customer_code1, $additional_card_acceptor_data, $austin_tetra_number, $naics_code, $card_acceptor_type, $card_acceptor_tax_id, $corporation_vat_number, $card_acceptor_reference_number, $freight_amount1, $duty_amount1, $ship_to_pos_code, $destination_province_code, $destination_country_code, $ship_from_pos_code, $order_date, $card_acceptor_vat_number, $customer_vat_number, $unique_invoice_number, $commodity_code, $authorized_contact_name, $authorized_contact_phone, McTax $mctax)
    {
        $this->data['customer_code1'] = $customer_code1;
        $this->data['additional_card_acceptor_data'] = $additional_card_acceptor_data;
        $this->data['austin_tetra_number'] = $austin_tetra_number;
        $this->data['naics_code'] = $naics_code;
        $this->data['card_acceptor_type'] = $card_acceptor_type;
        $this->data['card_acceptor_tax_id'] = $card_acceptor_tax_id;
        $this->data['corporation_vat_number'] = $corporation_vat_number;
        $this->data['card_acceptor_reference_number'] = $card_acceptor_reference_number;
        $this->data['freight_amount1'] = $freight_amount1;
        $this->data['duty_amount1'] = $duty_amount1;
        $this->data['ship_to_pos_code'] = $ship_to_pos_code;
        $this->data['destination_province_code'] = $destination_province_code;
        $this->data['destination_country_code'] = $destination_country_code;
        $this->data['ship_from_pos_code'] = $ship_from_pos_code;
        $this->data['order_date'] = $order_date;
        $this->data['card_acceptor_vat_number'] = $card_acceptor_vat_number;
        $this->data['customer_vat_number'] = $customer_vat_number;
        $this->data['unique_invoice_number'] = $unique_invoice_number;
        $this->data['commodity_code'] = $commodity_code;
        $this->data['authorized_contact_name'] = $authorized_contact_name;
        $this->data['authorized_contact_phone'] = $authorized_contact_phone;
        $this->data['tax'] = $mctax->getData();
    }

    public function setCustomerCode1($customer_code1)
    {
        $this->data['customer_code1'] = $customer_code1;
    }

    public function setAdditionalCardAcceptorData($additional_card_acceptor_data)
    {
        $this->data['additional_card_acceptor_data'] = $additional_card_acceptor_data;
    }

    public function setAustinTetraNumber($austin_tetra_number)
    {
        $this->data['austin_tetra_number'] = $austin_tetra_number;
    }

    public function setNaicsCode($naics_code)
    {
        $this->data['naics_code'] = $naics_code;
    }

    public function setCardAcceptorType($card_acceptor_type)
    {
        $this->data['card_acceptor_type'] = $card_acceptor_type;
    }

    public function setCardAcceptorTaxTd($card_acceptor_tax_id)
    {
        $this->data['card_acceptor_tax_id'] = $card_acceptor_tax_id;
    }

    public function setCorporationVatNumber($corporation_vat_number)
    {
        $this->data['corporation_vat_number'] = $corporation_vat_number;
    }

    public function setCardAcceptorReferenceNumber($card_acceptor_reference_number)
    {
        $this->data['card_acceptor_reference_number'] = $card_acceptor_reference_number;
    }

    public function setFreightAmount1($freight_amount1)
    {
        $this->data['freight_amount1'] = $freight_amount1;
    }

    public function setDutyAmount1($duty_amount1)
    {
        $this->data['duty_amount1'] = $duty_amount1;
    }

    public function setShipToPosCode($ship_to_pos_code)
    {
        $this->data['ship_to_pos_code'] = $ship_to_pos_code;
    }

    public function setDestinationProvinceCode($destination_province_code)
    {
        $this->data['destination_province_code'] = $destination_province_code;
    }

    public function setDestinationCountryCode($destination_country_code)
    {
        $this->data['destination_country_code'] = $destination_country_code;
    }

    public function setShipFromPosCode($ship_from_pos_code)
    {
        $this->data['ship_from_pos_code'] = $ship_from_pos_code;
    }

    public function setOrderDate($order_date)
    {
        $this->data['order_date'] = $order_date;
    }

    public function setCardAcceptorVatNumber($card_acceptor_vat_number)
    {
        $this->data['card_acceptor_vat_number'] = $card_acceptor_vat_number;
    }

    public function setCustomerVatNumber($customer_vat_number)
    {
        $this->data['customer_vat_number'] = $customer_vat_number;
    }

    public function setUniqueInvoiceNumber($unique_invoice_number)
    {
        $this->data['unique_invoice_number'] = $unique_invoice_number;
    }

    public function setCommodityCode($commodity_code)
    {
        $this->data['commodity_code'] = $commodity_code;
    }

    public function setAuthorizedContactName($authorized_contact_name)
    {
        $this->data['authorized_contact_name'] = $authorized_contact_name;
    }

    public function setAuthorizedContactPhone($authorized_contact_phone)
    {
        $this->data['authorized_contact_phone'] = $authorized_contact_phone;
    }

    public function setTax(McTax $mcTax)
    {
        $this->data['tax'] = $mcTax->getData();
    }

    public function getData()
    {
        return $this->data;
    }
}
