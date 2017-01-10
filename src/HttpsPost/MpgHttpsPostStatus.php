<?php

namespace Empg\HttpsPost;

use Empg\HttpsPost\Response\MpgResponse;
use Empg\HttpsPost\Request\MpgRequest;

class MpgHttpsPostStatus
{
    public $api_token;
    public $store_id;
    public $app_version;
    public $status;
    public $mpgRequest;
    public $mpgResponse;
    public $xmlString;

    public function __construct($storeid, $apitoken, $status, MpgRequest $mpgRequestOBJ)
    {
        $this->store_id = $storeid;
        $this->api_token = $apitoken;
        $this->app_version = null;
        $this->status = $status;
        $this->mpgRequest = $mpgRequestOBJ;

        $dataToSend = $this->toXML();

        //$transactionType=$mpgRequestOBJ->getTransactionType();

        $url = $this->mpgRequest->getURL();

        $httpsPost = new HttpsPost($url, $dataToSend);
        $response = $httpsPost->getHttpsResponse();

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

        $this->mpgResponse = new MpgResponse($response);
    }

    public function setAppVersion($app_version)
    {
        $this->app_version = $app_version;
    }

    public function getMpgResponse()
    {
        return $this->mpgResponse;
    }

    public function toXML()
    {
        $req = $this->mpgRequest;
        $reqXMLString = $req->toXML();

        $this->xmlString .= '<?xml version="1.0" encoding="iso-8859-1"?>'.
                               '<request>'.
                               "<store_id>$this->store_id</store_id>".
                               "<api_token>$this->api_token</api_token>";

        if ($this->app_version != null) {
            $this->xmlString .= "<app_version>$this->app_version</app_version>";
        }

        $this->xmlString .= "<status_check>$this->status</status_check>".
                            $reqXMLString.
                            '</request>';

        return $this->xmlString;
    }
}
