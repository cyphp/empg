<?php

namespace Empg\HttpsPost;

use Sabre\Xml\Writer;
use Empg\Configuration;
use Empg\HttpsPost\Request\AbstractRequest;

abstract class AbstractHttpsPost implements ExecutableInterface
{
    protected $config;
    protected $appVersion;

    protected $request;
    protected $response;

    public function __construct(Configuration $config, AbstractRequest $request)
    {
        $this->config = $config;
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
        // build xml request
        $writer = new Writer();
        $writer->namespaceMap['http://www.w3.org/1999/xhtml'] = '';

        $writer->openMemory();
        $writer->setIndent(false);
        $writer->startDocument('1.0', 'UTF-8');

        $writer->write($this);

        $handler = new HttpsPostHandler($this->config, $this->getRequestUrl(), $writer->outputMemory());
        $this->response = $handler->execute()->getHttpsResponse();

        return $this;
    }

    public function getResponse()
    {
        if (!isset($this->response)) {
            throw new \Exception('Run AbstractHttpsPost::execute() before getting a response');
        }

        return $this->response;
    }

    protected function getRequestUrl()
    {
        $settings = $this->config->getSettings();
        $isReqOfUSService = $this->request->isRequestOfUSService();
        $isMpiFile = $this->request->getIsMPI();

        $host = $settings['moneris']['host'][$isReqOfUSService ? 'us' : 'default'];
        $file = $isMpiFile ? $settings['moneris']['mpi'] : $settings['moneris']['file'];
        $file = $isReqOfUSService ? $file['us'] : $file['default'];

        $url = $settings['moneris']['protocol'].'://'.$host.':'.$settings['moneris']['port'].$file;

        return $url;
    }
}
