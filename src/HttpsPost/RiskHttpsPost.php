<?php

namespace Empg\HttpsPost;

use Empg\HttpsPost\Response\RiskResponse;

class RiskHttpsPost
{
    public function getRiskResponse()
    {
        $response = $this->getResponse();

        if (!$response) {
            $response = '<?xml version="1.0"?><response><receipt>'.
                    '<ReceiptId>Global Error Receipt</ReceiptId>'.
                    '<ResponseCode>null</ResponseCode>'.
                    '<AuthCode>null</AuthCode><TransTime>null</TransTime>'.
                    '<TransDate>null</TransDate><TransType>null</TransType><Complete>false</Complete>'.
                    '<Message>null</Message><TransAmount>null</TransAmount>'.
                    '<CardType>null</CardType>'.
                    '<TransID>null</TransID><TimedOut>null</TimedOut>'.
                    '</receipt></response>';
        }

        return new RiskResponse($response);
    }

    public function toXML()
    {
        $reqXMLString = $this->request->toXML();

        $xmlString = '<?xml version="1.0"?>'.
                    '<request>'.
                    "<store_id>{$this->storeId}</store_id>".
                    "<api_token>{$this->apiToken}</api_token>".
                    '<risk>'.
                    $reqXMLString.
                    '</risk>'.
                    '</request>';

        return $xmlString;
    }
}
