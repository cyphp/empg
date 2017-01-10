<?php

namespace Empg\HttpsPost;

use Empg\Mpg\Globals;

class HttpsPost
{
    protected $url;
    protected $dataToSend;
    protected $clientTimeOut;
    protected $apiVersion;
    protected $response;
    protected $debug = false; //default is false for production release

    public function __construct($url, $dataToSend)
    {
        $this->url = $url;
        $this->dataToSend = $dataToSend;

        if ($this->debug == true) {
            echo 'DataToSend= '.$this->dataToSend;
            echo "\n\nPostURL= ".$this->url;
        }

        $clientTimeOut = Globals::CLIENT_TIMEOUT;
        $apiVersion = Globals::API_VERSION;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->dataToSend);
        curl_setopt($ch, CURLOPT_TIMEOUT, $clientTimeOut);
        curl_setopt($ch, CURLOPT_USERAGENT, $apiVersion);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        //curl_setopt($ch, CURLOPT_CAINFO, "PATH_TO_CA_BUNDLE");

        $this->response = curl_exec($ch);

        curl_close($ch);

        if ($this->debug == true) {
            echo "\n\nRESPONSE= $this->response\n";
        }
    }

    public function getHttpsResponse()
    {
        return $this->response;
    }
}
