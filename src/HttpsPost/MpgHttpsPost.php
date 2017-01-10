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
        $reqXMLString = "<store_id>{$this->storeId}</store_id>".
                        "<api_token>{$this->apiToken}</api_token>";

        if ($this->appVersion) {
            $reqXMLString .= "<app_version>{$this->appVersion}</app_version>";
        }

        $reqXMLString .= $this->request->toXML();

        $requestTag = $this->request->getIsMPI() ? 'MpiRequest' : 'request';

        return '<?xml version="1.0" encoding="UTF-8"?>'.
                "<{$requestTag}>".$reqXMLString."</{$requestTag}>";
    }
}
