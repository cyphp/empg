<?php

namespace Empg\Mpg;

class MpgRecur extends AbstractTransactionField
{
    protected $fieldName = 'recur';
    public $recurTemplate = ['recur_unit', 'start_now', 'start_date', 'num_recurs', 'period', 'recur_amount'];

    public function __construct($params)
    {
        parent::__construct($params);

        if ((!$this->params['period'])) {
            $this->params['period'] = 1;
        }
    }
}
