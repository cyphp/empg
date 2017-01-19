<?php

namespace Empg\HttpsPost\Request;

use Empg\HttpsPost\Transaction\AbstractTransaction;

abstract class AbstractRequest
{
    protected $txnArray;
    protected $transactions;
    protected $procCountryCode = '';
    protected $testMode = '';

    public function __construct(AbstractTransaction ...$txn)
    {
        if (empty($txn)) {
            throw new \Exception('MpgRequest requires at least one MpgTransaction object');
        }

        $this->txnArray = $txn;
        $this->transactions = new \ArrayObject($txn);
    }

    public function getTransactionIterator()
    {
        return $this->transactions->getIterator();
    }

    public function setProcCountryCode($countryCode)
    {
        $this->procCountryCode = ((strcmp(strtolower($countryCode), 'us') >= 0) ? '_US' : '');
    }

    public function setTestMode(bool $state)
    {
        if ($state) {
            $this->testMode = '_TEST';
        } else {
            $this->testMode = '';
        }
    }

    abstract public function getURL();
}
