<?php

namespace Empg\Mpg\Mc;

class McCorpar
{
    private $template = array(
            'passenger_name1' => null,
            'ticket_number1' => null,
            'travel_agency_code' => null,
            'travel_agency_name' => null,
            'travel_date' => null,
            'sequence_number' => null,
            'procedure_id' => null,
            'service_type' => null,
            'service_nature' => null,
            'service_amount' => null,
            'full_vat_gross_amount' => null,
            'full_vat_tax_amount' => null,
            'half_vat_gross_amount' => null,
            'half_vat_tax_amount' => null,
            'traffic_code' => null,
            'sample_number' => null,
            'start_station' => null,
            'destination_station' => null,
            'generic_code' => null,
            'generic_number' => null,
            'generic_other_code' => null,
            'generic_other_number' => null,
            'reduction_code' => null,
            'reduction_number' => null,
            'reduction_other_code' => null,
            'reduction_other_number' => null,
            'transportation_other_code' => null,
            'number_of_adults' => null,
            'number_of_children' => null,
            'class_of_ticket' => null,
            'transportation_service_provider' => null,
            'transportation_service_offered' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setMcCorpar($passenger_name1, $ticket_number1, $travel_agency_code, $travel_agency_name, $travel_date, $sequence_number, $procedure_id, $service_type, $service_nature, $service_amount, $full_vat_gross_amount, $full_vat_tax_amount, $half_vat_gross_amount, $half_vat_tax_amount, $traffic_code, $sample_number, $start_station, $destination_station, $generic_code, $generic_number, $generic_other_code, $generic_other_number, $reduction_code, $reduction_number, $reduction_other_code, $reduction_other_number, $transportation_other_code, $number_of_adults, $number_of_children, $class_of_ticket, $transportation_service_provider, $transportation_service_offered)
    {
        $this->template['passenger_name1'] = $passenger_name1;
        $this->template['ticket_number1'] = $ticket_number1;
        $this->template['travel_agency_code'] = $travel_agency_code;
        $this->template['travel_agency_name'] = $travel_agency_name;
        $this->template['travel_date'] = $travel_date;
        $this->template['sequence_number'] = $sequence_number;
        $this->template['procedure_id'] = $procedure_id;
        $this->template['service_type'] = $service_type;
        $this->template['service_nature'] = $service_nature;
        $this->template['service_amount'] = $service_amount;
        $this->template['full_vat_gross_amount'] = $full_vat_gross_amount;
        $this->template['full_vat_tax_amount'] = $full_vat_tax_amount;
        $this->template['half_vat_gross_amount'] = $half_vat_gross_amount;
        $this->template['half_vat_tax_amount'] = $half_vat_tax_amount;
        $this->template['traffic_code'] = $traffic_code;
        $this->template['sample_number'] = $sample_number;
        $this->template['start_station'] = $start_station;
        $this->template['destination_station'] = $destination_station;
        $this->template['generic_code'] = $generic_code;
        $this->template['generic_number'] = $generic_number;
        $this->template['generic_other_code'] = $generic_other_code;
        $this->template['generic_other_number'] = $generic_other_number;
        $this->template['reduction_code'] = $reduction_code;
        $this->template['reduction_number'] = $reduction_number;
        $this->template['reduction_other_code'] = $reduction_other_code;
        $this->template['reduction_other_number'] = $reduction_other_number;
        $this->template['transportation_other_code'] = $transportation_other_code;
        $this->template['number_of_adults'] = $number_of_adults;
        $this->template['number_of_children'] = $number_of_children;
        $this->template['class_of_ticket'] = $class_of_ticket;
        $this->template['transportation_service_provider'] = $transportation_service_provider;
        $this->template['transportation_service_offered'] = $transportation_service_offered;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
