<?php

namespace Empg\HttpsPost;

use Empg\HttpsPost\Response\MpiResponse;

class MpiHttpsPost extends AbstractHttpsPost
{
    public function getMpiResponse()
    {
        $response = $this->getResponse();

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

        return new MpiResponse($response);
    }

    public function toXML()
    {
        $reqXMLString = $this->request->toXML();

        $xmlString = '<?xml version="1.0"?>'.
                    '<MpiRequest>'.
                    "<store_id>{$this->storeId}</store_id>".
                    "<api_token>{$this->apiToken}</api_token>".
                    $reqXMLString.
                    '</MpiRequest>';

        return $xmlString;
    }
}
