<?php

namespace Empg;

use Empg\HttpsPost\Request\MpgRequest;
use Empg\HttpsPost\MpgHttpsPost;

class Client
{
    protected $config;

    public function __construct(string $storeId, string $apiToken, $env = Configuration::ENV_PROD)
    {
        $this->config = new Configuration($storeId, $apiToken, [
            'env' => $env,
        ]);
    }

    public function post(MpgRequest $request)
    {
        $http = new MpgHttpsPost($this->config, $request);

        return $http->execute()->getMpgResponse();
    }
}
