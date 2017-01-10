<?php

namespace Empg\HttpsPost;

class RiskHttpsPost
{
    public $api_token;
    public $store_id;
    public $riskRequest;
    public $riskResponse;

    public function __construct($storeid, $apitoken, $riskRequestOBJ)
    {
        $this->store_id = $storeid;
        $this->api_token = $apitoken;
        $this->riskRequest = $riskRequestOBJ;

        $dataToSend = $this->toXML();

        $url = $this->riskRequest->getURL();

        $httpsPost = new HttpsPost($url, $dataToSend);
        $response = $httpsPost->getHttpsResponse();

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

        //print "Got a xml response of: \n$response\n";
        $this->riskResponse = new RiskResponse($response);
    }

    public function getRiskResponse()
    {
        return $this->riskResponse;
    }

    public function toXML()
    {
        $req = $this->riskRequest;
        $reqXMLString = $req->toXML();

        $xmlString = '<?xml version="1.0"?>'.
                    '<request>'.
                    "<store_id>$this->store_id</store_id>".
                    "<api_token>$this->api_token</api_token>".
                    '<risk>'.
                    $reqXMLString.
                    '</risk>'.
                    '</request>';

        return $xmlString;
    }
}
