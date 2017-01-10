<?php

namespace Empg\HttpsPost\Transaction;

abstract class AbstractTransaction
{
    protected $txn;

    public function __construct($txn)
    {
        $this->txn = $txn;
    }

    public function getTransaction()
    {
        return $this->txn;
    }

    public function getTransactionType()
    {
        if (isset($this->txn['type'])) {
            return $this->txn['type'];
        }

        throw new \Exception('Missing transaction type');
    }
}
