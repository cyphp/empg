<?php

namespace Empg\Mpg;

class MpgAvsInfo extends AbstractTransactionField
{
    protected $fieldName = 'avs_info';
    public $avsTemplate = ['avs_street_number', 'avs_street_name', 'avs_zipcode', 'avs_email', 'avs_hostname', 'avs_browser', 'avs_shiptocountry', 'avs_shipmethod', 'avs_merchprodsku', 'avs_custip', 'avs_custphone'];
}
