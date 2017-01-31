<?php

namespace Empg\HttpsPost;

use Empg\Configuration;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;

class HttpsPostHandler implements ExecutableInterface
{
    protected $url;
    protected $config;
    protected $dataToSend;

    protected $response;
    protected $debug = false; //default is false for production release

    public function __construct(Configuration $config, $url, $dataToSend)
    {
        $this->config = $config;
        $this->url = $url;
        $this->dataToSend = $dataToSend;
    }

    public function execute()
    {
        $settings = $this->config->getSettings();

        if ($this->config->isDebugging()) {
            echo 'DataToSend= '.$this->dataToSend;
            echo "\n\nPostURL= ".$this->url;
        }

        $client = new Client([
            'curl' => [
                CURLOPT_USERAGENT => $settings['moneris']['version'],
            ],
            'timeout' => $settings['moneris']['timeout'],
        ]);

        try {
            $guzzleResponse = $client->post($this->url, [
                'body' => $this->dataToSend,
            ]);

            $this->response = (string) $guzzleResponse->getBody();
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());

            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        } catch (ConnectException $e) {
            echo Psr7\str($e->getRequest());

            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        } catch (ServerException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        } catch (TooManyRedirectsException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        }

        if ($this->config->isDebugging()) {
            echo "\n\nRESPONSE= $this->response\n";
        }

        return $this;
    }

    public function getHttpsResponse()
    {
        return $this->response;
    }
}
