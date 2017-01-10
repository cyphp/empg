<?php

namespace Empg\Mpg\Mc;

class McCorpai
{
    private $template = array(
            'passenger_name1' => null,
            'ticket_number1' => null,
            'issuing_carrier' => null,
            'customer_code1' => null,
            'issue_date' => null,
            'travel_agency_code' => null,
            'travel_agency_name' => null,
            'total_fare' => null,
            'total_fee' => null,
            'total_taxes' => null,
            'commodity_code' => null,
            'restricted_ticket_indicator' => null,
            'exchange_ticket_amount' => null,
            'exchange_fee_amount' => null,
            'travel_authorization_code' => null,
            'iata_client_code' => null,
            'tax' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setMcCorpai($passenger_name1, $ticket_number1, $issuing_carrier, $customer_code1, $issue_date, $travel_agency_code, $travel_agency_name, $total_fare, $total_fee, $total_taxes, $commodity_code, $restricted_ticket_indicator, $exchange_ticket_amount, $exchange_fee_amount, $travel_authorization_code, $iata_client_code, McTax $mctax)
    {
        $this->data['passenger_name1'] = $passenger_name1;
        $this->data['ticket_number1'] = $ticket_number1;
        $this->data['issuing_carrier'] = $issuing_carrier;
        $this->data['customer_code1'] = $customer_code1;
        $this->data['issue_date'] = $issue_date;
        $this->data['travel_agency_code'] = $travel_agency_code;
        $this->data['travel_agency_name'] = $travel_agency_name;
        $this->data['total_fare'] = $total_fare;
        $this->data['total_fee'] = $total_fee;
        $this->data['total_taxes'] = $total_taxes;
        $this->data['commodity_code'] = $commodity_code;
        $this->data['restricted_ticket_indicator'] = $restricted_ticket_indicator;
        $this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
        $this->data['exchange_fee_amount'] = $exchange_fee_amount;
        $this->data['travel_authorization_code'] = $travel_authorization_code;
        $this->data['iata_client_code'] = $iata_client_code;
        $this->data['tax'] = $mctax->getData();
    }

    public function setPassengerName1($passenger_name1)
    {
        $this->data['passenger_name1'] = $passenger_name1;
    }

    public function setTicketNumber1($ticket_number1)
    {
        $this->data['ticket_number1'] = $ticket_number1;
    }

    public function setIssuingCarrier($issuing_carrier)
    {
        $this->data['issuing_carrier'] = $issuing_carrier;
    }

    public function setCustomerCode1($customer_code1)
    {
        $this->data['customer_code1'] = $customer_code1;
    }

    public function setIssueDate($issue_date)
    {
        $this->data['issue_date'] = $issue_date;
    }

    public function setTravelAgencyCode($travel_agency_code)
    {
        $this->data['travel_agency_code'] = $travel_agency_code;
    }

    public function setTravelAgencyName($travel_agency_name)
    {
        $this->data['travel_agency_name'] = $travel_agency_name;
    }

    public function setTotalFare($total_fare)
    {
        $this->data['total_fare'] = $total_fare;
    }

    public function setTotalFee($total_fee)
    {
        $this->data['total_fee'] = $total_fee;
    }

    public function setTotalTaxes($total_taxes)
    {
        $this->data['total_taxes'] = $total_taxes;
    }

    public function setCommodityCode($commodity_code)
    {
        $this->data['commodity_code'] = $commodity_code;
    }

    public function setRestrictedTicketIndicator($restricted_ticket_indicator)
    {
        $this->data['restricted_ticket_indicator'] = $restricted_ticket_indicator;
    }

    public function setExchangeTicketAmount($exchange_ticket_amount)
    {
        $this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
    }

    public function setExchangeFeeAmount($exchange_fee_amount)
    {
        $this->data['exchange_fee_amount'] = $exchange_fee_amount;
    }

    public function setTravelAuthorizationCode($travel_authorization_code)
    {
        $this->data['travel_authorization_code'] = $travel_authorization_code;
    }

    public function setIataClientCode($iata_client_code)
    {
        $this->data['iata_client_code'] = $iata_client_code;
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
