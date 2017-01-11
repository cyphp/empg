<?php

namespace Empg\HttpsPost;

use Empg\HttpsPost\Response\MpgResponse;

class MpgHttpsPost extends AbstractHttpsPost
{
    public function getMpgResponse()
    {
        $response = $this->getResponse();

        if (!$response) {
            $response = '<?xml version="1.0"?><response><receipt>'.
                '<ReceiptId>Global Error Receipt</ReceiptId>'.
                '<ReferenceNum>null</ReferenceNum><ResponseCode>null</ResponseCode>'.
                '<AuthCode>null</AuthCode><TransTime>null</TransTime>'.
                '<TransDate>null</TransDate><TransType>null</TransType><Complete>false</Complete>'.
                '<Message>Global Error Receipt</Message><TransAmount>null</TransAmount>'.
                '<CardType>null</CardType>'.
                '<TransID>null</TransID><TimedOut>null</TimedOut>'.
                '<CorporateCard>false</CorporateCard><MessageId>null</MessageId>'.
                '</receipt></response>';
        }

        return new MpgResponse($response);
    }

    public function toXML()
    {
        $dom = new \DomDocument('1.0', 'UTF-8');

        $requestNode = $dom->createElement($this->request->getIsMPI() ? 'MpiRequest' : 'request');
        $dom->appendChild($requestNode);

        $requestNode->appendChild($dom->createElement('store_id', $this->storeId));
        $requestNode->appendChild($dom->createElement('api_token', $this->apiToken));

        if ($this->appVersion) {
            $requestNode->appendChild($dom->createElement('app_version', $this->appVersion));
        }

        $requestNode->appendChild($dom->importNode($this->request->toXML(true)->documentElement, true));

        return $dom->saveXML();
    }
}
