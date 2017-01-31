<?php

namespace Empg\HttpsPost\Request;

class RiskRequest extends AbstractRequest
{
    protected $txnTypes = [
        'session_query' => ['order_id', 'session_id', 'service_type', 'event_type'],
        'attribute_query' => ['order_id', 'policy_id', 'service_type'],
        'assert' => ['orig_order_id', 'activities_description', 'impact_description', 'confidence_description'],
    ];

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
                    $txnXMLString .= "<$txnTypeArray[$i]>".//begin tag
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
