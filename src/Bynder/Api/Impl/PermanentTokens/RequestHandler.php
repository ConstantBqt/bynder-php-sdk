<?php

namespace Bynder\Api\Impl\PermanentTokens;

use Guzzle;

use Bynder\Api\Impl\AbstractRequestHandler;

class RequestHandler extends AbstractRequestHandler
{
    protected $configuration;
    protected $httpClient;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
        $this->httpClient = new \GuzzleHttp\Client();
    }

    protected function sendAuthenticatedRequest($requestMethod, $uri, $options = [])
    {
        $request = new \GuzzleHttp\Psr7\Request($requestMethod, $uri, array_filter(
            $options,
            function ($key) {
                return !in_array($key, ['form_params', 'json']);
            },
            ARRAY_FILTER_USE_KEY
        ));

        $requestOptions = array_merge(
            $options,
            $this->configuration->getRequestOptions(),
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->configuration->getToken(),
                ],
            ]
        );

        if (!isset($requestOptions['headers']['User-Agent'])) {
            $requestOptions['headers']['User-Agent'] = 'bynder-php-sdk/' . $this->configuration->getSdkVersion();
        }

        return $this->httpClient->sendAsync($request, $requestOptions);
    }
}
