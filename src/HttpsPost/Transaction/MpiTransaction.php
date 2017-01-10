<?php

namespace Empg\HttpsPost\Transaction;

class MpiTransaction
{
    public $txn;

    public function __construct($txn)
    {
        $this->txn = $txn;
    }

    public function getTransaction()
    {
        return $this->txn;
    }
}
