<?php

namespace Empg;

use Empg\HttpsPost\Request\MpgRequest;
use Empg\HttpsPost\MpgHttpsPost;

class Client
{
    protected $config;

    public function __construct(string $storeId, string $apiToken, $options = [])
    {
        $options = array_merge([
            'env' => Configuration::ENV_PROD,
            'debug' => false,
        ], $options);

        $this->config = new Configuration($storeId, $apiToken, $options);
    }

    public function post(MpgRequest $request)
    {
        $http = new MpgHttpsPost($this->config, $request);

        return $http->execute()->getMpgResponse();
    }
}
