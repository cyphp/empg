<?php

namespace Empg\HttpsPost;

use Empg\HttpsPost\Response\MpgResponse;

class MpgHttpsPost
{
    protected $api_token;
    protected $store_id;
    protected $app_version;
    protected $mpgRequest;
    protected $mpgResponse;
    protected $xmlString;
    protected $txnType;
    protected $isMPI;

    public function __constrcut($storeid, $apitoken, $mpgRequestOBJ)
    {
        $this->store_id = $storeid;
        $this->api_token = $apitoken;
        $this->app_version = null;
        $this->mpgRequest = $mpgRequestOBJ;
        $this->isMPI = $mpgRequestOBJ->getIsMPI();

        $dataToSend = $this->toXML();

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

        if ($this->isMPI === true) {
            $this->xmlString .= '<?xml version="1.0"?>'.
                                '<MpiRequest>'.
                                    "<store_id>$this->store_id</store_id>".
                                    "<api_token>$this->api_token</api_token>";

            if ($this->app_version != null) {
                $this->xmlString .= "<app_version>$this->app_version</app_version>";
            }

            $this->xmlString .=    $reqXMLString.
                                '</MpiRequest>';
        } else {
            $this->xmlString .= '<?xml version="1.0" encoding="UTF-8"?>'.
                                   '<request>'.
                                       "<store_id>$this->store_id</store_id>".
                                       "<api_token>$this->api_token</api_token>";

            if ($this->app_version != null) {
                $this->xmlString .= "<app_version>$this->app_version</app_version>";
            }

            $this->xmlString .=        $reqXMLString.
                                '</request>';
        }

        return $this->xmlString;
    }
}
