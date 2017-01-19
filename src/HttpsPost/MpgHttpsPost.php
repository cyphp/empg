<?php

namespace Empg\HttpsPost;

use Sabre\Xml\XmlSerializable;
use Sabre\Xml\Writer;
use Empg\HttpsPost\Response\MpgResponse;

class MpgHttpsPost extends AbstractHttpsPost implements XmlSerializable
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

    public function xmlSerialize(Writer $writer)
    {
        $serialized = [];
        $type = $this->request->getIsMPI() ? 'MpiRequest' : 'request';

        $serialized[$type] = [
            'store_id' => $this->storeId,
            'api_token' => $this->apiToken,
            $this->request
        ];

        if ($this->appVersion) {
            $serialized[$type]['app_version'] = $this->appVersion;
        }

        $writer->write($serialized);
    }
}
