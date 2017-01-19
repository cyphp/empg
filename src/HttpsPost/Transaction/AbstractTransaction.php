<?php

namespace Empg\HttpsPost\Transaction;

abstract class AbstractTransaction
{
    protected $txn;

    public function __construct(array $txn)
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

    public function hasOption(string $key)
    {
        return isset($this->txn[$key]);
    }

    public function getOption(string $key)
    {
        if ($this->hasOption($key)) {
            return $this->txn[$key];
        }

        return;
    }

    public function isMpiTransaction()
    {
        $transactionType = $this->getTransactionType();

        return $transactionType === 'txn' || $transactionType === 'acs';
    }

    public function isGroupTransaction()
    {
        $transactionType = $this->getTransactionType();

        return $transactionType === 'group';
    }

    public function isRiskTransaction()
    {
        $transactionType = $this->getTransactionType();

        return $transactionType === 'attribute_query' || $transactionType === 'session_query';
    }
}
