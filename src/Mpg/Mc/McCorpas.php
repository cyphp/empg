<?php

namespace Empg\Mpg\Mc;

class McCorpas
{
    private $template = array(
            'travel_date' => null,
            'carrier_code1' => null,
            'service_class' => null,
            'orig_city_airport_code' => null,
            'dest_city_airport_code' => null,
            'stop_over_code' => null,
            'conjunction_ticket_number1' => null,
            'exchange_ticket_number' => null,
            'coupon_number1' => null,
            'fare_basis_code1' => null,
            'flight_number' => null,
            'departure_time' => null,
            'arrival_time' => null,
            'fare' => null,
            'fee' => null,
            'taxes' => null,
            'endorsement_restrictions' => null,
            'tax' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setMcCorpas($travel_date, $carrier_code1, $service_class, $orig_city_airport_code, $dest_city_airport_code, $stop_over_code, $conjunction_ticket_number1, $exchange_ticket_number1, $coupon_number1, $fare_basis_code1, $flight_number, $departure_time, $arrival_time, $fare, $fee, $taxes, $endorsement_restrictions, McTax $mcTax)
    {
        $this->template['travel_date'] = $travel_date;
        $this->template['carrier_code1'] = $carrier_code1;
        $this->template['service_class'] = $service_class;
        $this->template['orig_city_airport_code'] = $orig_city_airport_code;
        $this->template['dest_city_airport_code'] = $dest_city_airport_code;
        $this->template['stop_over_code'] = $stop_over_code;
        $this->template['conjunction_ticket_number1'] = $conjunction_ticket_number1;
        $this->template['exchange_ticket_number'] = $exchange_ticket_number1;
        $this->template['coupon_number1'] = $coupon_number1;
        $this->template['fare_basis_code1'] = $fare_basis_code1;
        $this->template['flight_number'] = $flight_number;
        $this->template['departure_time'] = $departure_time;
        $this->template['arrival_time'] = $arrival_time;
        $this->template['fare'] = $fare;
        $this->template['fee'] = $fee;
        $this->template['taxes'] = $taxes;
        $this->template['endorsement_restrictions'] = $endorsement_restrictions;
        $this->template['tax'] = $mcTax->getData();

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
