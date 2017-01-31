<?php

namespace Empg;

use Symfony\Component\Yaml\Yaml;

class Configuration
{
    const ENV_TEST = 'test';
    const ENV_PROD = 'prod';

    protected $apiToken;
    protected $storeId;
    protected $settings;

    protected $options;

    public function __construct($storeId, $apiToken, array $options = [])
    {
        $this->apiToken = $apiToken;
        $this->storeId = $storeId;
        $this->options = $options;

        $this->settings = Yaml::parse(file_get_contents(__DIR__.'/../config/'.$this->env.'.yml'));
    }

    public function isDebugging()
    {
        return $this->options['debug'];
    }

    public function getApiToken()
    {
        return $this->apiToken;
    }

    public function getStoreId()
    {
        return $this->storeId;
    }

    public function getSettings()
    {
        return $this->settings;
    }
}
