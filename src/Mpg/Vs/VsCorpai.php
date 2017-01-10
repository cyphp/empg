<?php

namespace Empg\Mpg\Vs;

class VsCorpai
{
    private $template = array(
            'ticket_number' => null,
            'passenger_name1' => null,
            'total_fee' => null,
            'exchange_ticket_number' => null,
            'exchange_ticket_amount' => null,
            'travel_agency_code' => null,
            'travel_agency_name' => null,
            'internet_indicator' => null,
            'electronic_ticket_indicator' => null,
            'vat_ref_num' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setCorpai($ticket_number, $passenger_name1, $total_fee, $exchange_ticket_number, $exchange_ticket_amount, $travel_agency_code, $travel_agency_name, $internet_indicator, $electronic_ticket_indicator, $vat_ref_num)
    {
        $this->data['ticket_number'] = $ticket_number;
        $this->data['passenger_name1'] = $passenger_name1;
        $this->data['total_fee'] = $total_fee;
        $this->data['exchange_ticket_number'] = $exchange_ticket_number;
        $this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
        $this->data['travel_agency_code'] = $travel_agency_code;
        $this->data['travel_agency_name'] = $travel_agency_name;
        $this->data['internet_indicator'] = $internet_indicator;
        $this->data['electronic_ticket_indicator'] = $electronic_ticket_indicator;
        $this->data['vat_ref_num'] = $vat_ref_num;
    }

    public function setTicketNumber($ticket_number)
    {
        $this->data['ticket_number'] = $ticket_number;
    }

    public function setPassengerName1($passenger_name1)
    {
        $this->data['passenger_name1'] = $passenger_name1;
    }

    public function setTotalFee($total_fee)
    {
        $this->data['total_fee'] = $total_fee;
    }

    public function setExchangeTicketNumber($exchange_ticket_number)
    {
        $this->data['exchange_ticket_number'] = $exchange_ticket_number;
    }

    public function setExchangeTicketAmount($exchange_ticket_amount)
    {
        $this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
    }

    public function setTravelAgencyCode($travel_agency_code)
    {
        $this->data['travel_agency_code'] = $travel_agency_code;
    }

    public function setTravelAgencyName($travel_agency_name)
    {
        $this->data['travel_agency_name'] = $travel_agency_name;
    }

    public function setInternetIndicator($internet_indicator)
    {
        $this->data['internet_indicator'] = $internet_indicator;
    }

    public function setElectronicTicketIndicator($electronic_ticket_indicator)
    {
        $this->data['electronic_ticket_indicator'] = $electronic_ticket_indicator;
    }

    public function setVatRefNum($vat_ref_num)
    {
        $this->data['vat_ref_num'] = $vat_ref_num;
    }

    public function getData()
    {
        return $this->data;
    }
}
