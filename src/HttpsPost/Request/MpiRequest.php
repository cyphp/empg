<?php

namespace Empg\HttpsPost\Request;

use Empg\Mpg\Globals;

class MpiRequest
{
    public $txnTypes = array(
        'txn' => array('xid', 'amount', 'pan', 'expdate', 'MD', 'merchantUrl', 'accept', 'userAgent', 'currency', 'recurFreq', 'recurEnd', 'install'),
        'acs' => array('PaRes', 'MD'),
    );

    public $txnArray;
    public $procCountryCode = '';
    public $testMode = '';

    public function __construct($txn)
    {
        if (is_array($txn)) {
            $this->txnArray = $txn;
        } else {
            $temp[0] = $txn;
            $this->txnArray = $temp;
        }
    }
    public function setProcCountryCode($countryCode)
    {
        $this->procCountryCode = ((strcmp(strtolower($countryCode), 'us') >= 0) ? '_US' : '');
    }

    public function setTestMode($state)
    {
        if ($state === true) {
            $this->testMode = '_TEST';
        } else {
            $this->testMode = '';
        }
    }

    public function getURL()
    {
        //$txnType = $this->getTransactionType();

        $hostId = 'MONERIS'.$this->procCountryCode.$this->testMode.'_HOST';
        $fileId = 'MONERIS'.$this->procCountryCode.'_MPI_FILE';

        $url = Globals::MONERIS_PROTOCOL.'://'.
            constant(Globals::class.'::'.$hostId).':'.
            Globals::MONERIS_PORT.
            constant(Globals::class.'::'.$fileId);

        //echo "PostURL: " . $url;

        return $url;
    }

    public function toXML()
    {
        $xmlString = '';
        $tmpTxnArray = $this->txnArray;
        $txnArrayLen = count($tmpTxnArray); //total number of transactions

        for ($x = 0; $x < $txnArrayLen; ++$x) {
            $txnObj = $tmpTxnArray[$x];
            $txn = $txnObj->getTransaction();

            $txnType = array_shift($txn);
            $tmpTxnTypes = $this->txnTypes;
            $txnTypeArray = $tmpTxnTypes[$txnType];
            $txnTypeArrayLen = count($txnTypeArray); //length of a specific txn type

            $txnXMLString = '';

            for ($i = 0; $i < $txnTypeArrayLen; ++$i) {
                //Will only add to the XML if the tag was passed in by merchant
                if (array_key_exists($txnTypeArray[$i], $txn)) {
                    $txnXMLString  .= "<$txnTypeArray[$i]>".//begin tag
                        $txn[$txnTypeArray[$i]].// data
                        "</$txnTypeArray[$i]>"; //end tag
                }
            }

            $txnXMLString = "<$txnType>$txnXMLString";

            $txnXMLString .= "</$txnType>";

            $xmlString .= $txnXMLString;
        }

        return $xmlString;
    }
}
