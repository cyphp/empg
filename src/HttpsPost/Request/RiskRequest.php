<?php

namespace Empg\HttpsPost\Request;

use Empg\Mpg\Globals;

class RiskRequest
{
    public $txnTypes = array(
        'session_query' => array('order_id', 'session_id', 'service_type', 'event_type'),
        'attribute_query' => array('order_id', 'policy_id', 'service_type'),
        'assert' => array('orig_order_id', 'activities_description', 'impact_description', 'confidence_description'),
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
        $fileId = 'MONERIS'.$this->procCountryCode.'_FILE';

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

            $sessionQuery = $txnObj->getSessionAccountInfo();

            if ($sessionQuery != null) {
                $txnXMLString .= $sessionQuery->toXML();
            }

            $attributeQuery = $txnObj->getAttributeAccountInfo();

            if ($attributeQuery != null) {
                $txnXMLString .= $attributeQuery->toXML();
            }

            $txnXMLString .= "</$txnType>";

            $xmlString .= $txnXMLString;

            return $xmlString;
        }

        return $xmlString;
    }
}
