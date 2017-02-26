<?php

namespace Empg\Mpg;

class MpgCvdInfo extends AbstractTransactionField
{
    protected $fieldName = 'cvd_info';
    public $cvdTemplate = ['cvd_indicator', 'cvd_value'];
}
