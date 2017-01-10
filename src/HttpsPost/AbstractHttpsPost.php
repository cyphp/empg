<?php

namespace Empg\HttpsPost;

use Empg\HttpsPost\Request\AbstractRequest;

abstract class AbstractHttpsPost
{
    protected $apiToken;
    protected $storeId;
    protected $appVersion;

    protected $request;
    protected $response;

    public function __construct($storeId, $apiToken, AbstractRequest $request)
    {
        $this->apiToken = $apiToken;
        $this->storeId = $storeId;
        $this->request = $request;

        $this->setAppVersion();
    }

    public function setAppVersion(string $appVersion = null)
    {
        $this->appVersion = $appVersion;

        return $this;
    }

    public function execute()
    {
        $handler = new HttpsPostHandler($this->request->getURL(), $this->toXML());
        $this->response = $handler->getHttpsResponse();

        return $this;
    }

    public function getResponse()
    {
        if (!isset($this->response)) {
            throw new \Exception('Run AbstractHttpsPost::execute() before getting a response');
        }

        return $this->response;
    }

    abstract public function toXML();
}
