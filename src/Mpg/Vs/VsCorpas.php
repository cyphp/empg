<?php

namespace Empg\Mpg\Vs;

class VsCorpas
{
    private $template = array(
            'conjunction_ticket_number' => null,
            'trip_leg_info' => null,
            'control_id' => null,
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setCorpas($conjunction_ticket_number, VsTripLegInfo $vsTripLegInfo, $control_id)
    {
        $this->template['conjunction_ticket_number'] = $conjunction_ticket_number;
        $this->template['trip_leg_info'] = $vsTripLegInfo->getData();
        $this->template['control_id'] = $control_id;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}
