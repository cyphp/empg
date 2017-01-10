<?php

namespace Empg\HttpsPost;

use Empg\HttpsPost\Response\MpiResponse;

class MpiHttpsPost
{
    public $api_token;
    public $store_id;
    public $mpiRequest;
    public $mpiResponse;

    public function __construct($storeid, $apitoken, $mpiRequestOBJ)
    {
        $this->store_id = $storeid;
        $this->api_token = $apitoken;
        $this->mpiRequest = $mpiRequestOBJ;
        $dataToSend = $this->toXML();

        $url = $this->mpiRequest->getURL();

        $httpsPost = new HttpsPost($url, $dataToSend);
        $response = $httpsPost->getHttpsResponse();

        if (!$response) {
            $response = '<?xml version="1.0"?>'.
                    '<MpiResponse>'.
                    '<type>null</type>'.
                    '<success>false</success>'.
                    '<message>null</message>'.
                    '<PaReq>null</PaReq>'.
                    '<TermUrl>null</TermUrl>'.
                    '<MD>null</MD>'.
                    '<ACSUrl>null</ACSUrl>'.
                    '<cavv>null</cavv>'.
                    '<PAResVerified>null</PAResVerified>'.
                    '</MpiResponse>';
        }

        $this->mpiResponse = new MpiResponse($response);
    }

    public function getMpiResponse()
    {
        return $this->mpiResponse;
    }

    public function toXML()
    {
        $req = $this->mpiRequest;
        $reqXMLString = $req->toXML();

        $xmlString = '<?xml version="1.0"?>'.
                    '<MpiRequest>'.
                    "<store_id>$this->store_id</store_id>".
                    "<api_token>$this->api_token</api_token>".
                    $reqXMLString.
                    '</MpiRequest>';

        return $xmlString;
    }
}
