<?php

namespace Empg\Mpg\Ax;

class MpgAxRaLevel23
{
    private $template = array(
            'axralevel23' => array(
                    'airline_process_id' => null,
                    'invoice_batch' => null,
                    'establishment_name' => null,
                    'carrier_name' => null,
                    'ticket_id' => null,
                    'issue_city' => null,
                    'establishment_state' => null,
                    'number_in_party' => null,
                    'passenger_name' => null,
                    'taa_routing' => null,
                    'carrier_code' => null,
                    'fare_basis' => null,
                    'document_type' => null,
                    'doc_number' => null,
                    'departure_date' => null,
            ),
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setAxRaLevel23($airline_process_id, $invoice_batch, $establishment_name, $carrier_name, $ticket_id, $issue_city, $establishment_state, $number_in_party, $passenger_name, $taa_routing, $carrier_code, $fare_basis, $document_type, $doc_number, $departure_date)
    {
        $this->data['axralevel23']['airline_process_id'] = $airline_process_id;
        $this->data['axralevel23']['invoice_batch'] = $invoice_batch;
        $this->data['axralevel23']['establishment_name'] = $establishment_name;
        $this->data['axralevel23']['carrier_name'] = $carrier_name;
        $this->data['axralevel23']['ticket_id'] = $ticket_id;
        $this->data['axralevel23']['issue_city'] = $issue_city;
        $this->data['axralevel23']['establishment_state'] = $establishment_state;
        $this->data['axralevel23']['number_in_party'] = $number_in_party;
        $this->data['axralevel23']['passenger_name'] = $passenger_name;
        $this->data['axralevel23']['taa_routing'] = $taa_routing;
        $this->data['axralevel23']['carrier_code'] = $carrier_code;
        $this->data['axralevel23']['fare_basis'] = $fare_basis;
        $this->data['axralevel23']['document_type'] = $document_type;
        $this->data['axralevel23']['doc_number'] = $doc_number;
        $this->data['axralevel23']['departure_date'] = $departure_date;
    }

    public function setAirlineProcessId($airline_process_id)
    {
        $this->data['axralevel23']['airline_process_id'] = $airline_process_id;
    }

    public function setInvoiceBatch($invoice_batch)
    {
        $this->data['axralevel23']['invoice_batch'] = $invoice_batch;
    }

    public function setEstablishmentName($establishment_name)
    {
        $this->data['axralevel23']['establishment_name'] = $establishment_name;
    }

    public function setCarrierName($carrier_name)
    {
        $this->data['axralevel23']['carrier_name'] = $carrier_name;
    }

    public function setTicketId($ticket_id)
    {
        $this->data['axralevel23']['ticket_id'] = $ticket_id;
    }

    public function setIssueCity($issue_city)
    {
        $this->data['axralevel23']['issue_city'] = $issue_city;
    }

    public function setEstablishmentState($establishment_state)
    {
        $this->data['axralevel23']['establishment_state'] = $establishment_state;
    }

    public function setNumberInParty($number_in_party)
    {
        $this->data['axralevel23']['number_in_party'] = $number_in_party;
    }

    public function setPassengerName($passenger_name)
    {
        $this->data['axralevel23']['passenger_name'] = $passenger_name;
    }

    public function setTaaRouting($taa_routing)
    {
        $this->data['axralevel23']['taa_routing'] = $taa_routing;
    }

    public function setCarrierCode($carrier_code)
    {
        $this->data['axralevel23']['carrier_code'] = $carrier_code;
    }

    public function setFareBasis($fare_basis)
    {
        $this->data['axralevel23']['fare_basis'] = $fare_basis;
    }

    public function setDocumentType($document_type)
    {
        $this->data['axralevel23']['document_type'] = $document_type;
    }

    public function setDocNumber($doc_number)
    {
        $this->data['axralevel23']['doc_number'] = $doc_number;
    }

    public function setDepartureDate($departure_date)
    {
        $this->data['axralevel23']['departure_date'] = $departure_date;
    }

    public function toXML()
    {
        $xmlString = $this->toXML_low($this->data, 'axralevel23');

        return $xmlString;
    }

    private function toXML_low($dataArray, $root)
    {
        $xmlRoot = '';

        foreach ($dataArray as $key => $value) {
            if (!is_numeric($key) && $value != '' && $value != null) {
                $xmlRoot .= "<$key>";
            } elseif (is_numeric($key) && $key != '0') {
                $xmlRoot .= "</$root><$root>";
            }

            if (is_array($value)) {
                $xmlRoot .= $this->toXML_low($value, $key);
            } else {
                $xmlRoot .= $value;
            }

            if (!is_numeric($key) && $value != '' && $value != null) {
                $xmlRoot .= "</$key>";
            }
        }

        return $xmlRoot;
    }

    public function getData()
    {
        return $this->data;
    }
}
