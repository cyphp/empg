<?php

namespace Empg\HttpsPost;

class MpgHttpsPostStatus extends MpgHttpsPost
{
    protected $status;
    protected $xmlString;

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function toXML()
    {
        $reqXMLString = $this->request->toXML();

        $this->xmlString .= '<?xml version="1.0" encoding="iso-8859-1"?>'.
                               '<request>'.
                               "<store_id>{$this->storeId}</store_id>".
                               "<api_token>{$this->apiToken}</api_token>";

        if ($this->appVersion != null) {
            $this->xmlString .= "<app_version>{$this->appVersion}</app_version>";
        }

        $this->xmlString .= "<status_check>{$this->status}</status_check>".
                            $reqXMLString.
                            '</request>';

        return $this->xmlString;
    }
}
