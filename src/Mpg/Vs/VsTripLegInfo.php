<?php

namespace Empg\Mpg\Vs;

class VsTripLegInfo
{
    private $template = array(
            'coupon_number' => null,
            'carrier_code1' => null,
            'flight_number' => null,
            'service_class' => null,
            'orig_city_airport_code' => null,
            'stop_over_code' => null,
            'dest_city_airport_code' => null,
            'fare_basis_code' => null,
            'departure_date1' => null,
            'departure_time' => null,
            'arrival_time' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setTripLegInfo($coupon_number, $carrier_code1, $flight_number, $service_class, $orig_city_airport_code, $stop_over_code, $dest_city_airport_code, $fare_basis_code, $departure_date1, $departure_time, $arrival_time)
    {
        $this->template['coupon_number'] = $coupon_number;
        $this->template['carrier_code1'] = $carrier_code1;
        $this->template['flight_number'] = $flight_number;
        $this->template['service_class'] = $service_class;
        $this->template['orig_city_airport_code'] = $orig_city_airport_code;
        $this->template['stop_over_code'] = $stop_over_code;
        $this->template['dest_city_airport_code'] = $dest_city_airport_code;
        $this->template['fare_basis_code'] = $fare_basis_code;
        $this->template['departure_date1'] = $departure_date1;
        $this->template['departure_time'] = $departure_time;
        $this->template['arrival_time'] = $arrival_time;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
