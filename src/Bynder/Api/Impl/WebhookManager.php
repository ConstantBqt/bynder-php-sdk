<?php
/**
 *
 * Copyright (c) Bynder. All rights reserved.
 *
 * Licensed under the MIT License. For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bynder\Api\Impl;

class WebhookManager
{
    /**
     * @var AbstractRequestHandler Request handler used to communicate with the API.
     */
    protected $requestHandler;

    /**
     * Initialises a new instance of the class.
     *
     * @param AbstractRequestHandler $requestHandler Request handler used to communicate with the API.
     */
    public function __construct(AbstractRequestHandler $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    /**
     * Gets a list of all webhook configurations available.
     *
     * @return \GuzzleHttp\Promise\Promise
     * @throws \GuzzleHttp\Exception\RequestException
     */
    public function getConfigurations()
    {
        return $this->requestHandler->sendRequestAsync('GET', 'v7/webhooks/public/api/subscriptions');
    }

    /**
     * Creates a webhook configuration.
     *
     * @param array $data
     *
     * @return \GuzzleHttp\Promise\Promise
     * @throws \Exception
     */
    public function createConfiguration($data)
    {
        return $this->requestHandler->sendRequestAsync(
            'POST', 'v7/webhooks/public/api/subscriptions',
            ['json' => $data]
        );
    }

    /**
     * Updates a webhook configuration.
     *
     * @param array $data
     *
     * @return \GuzzleHttp\Promise\Promise
     * @throws \Exception
     */
    public function updateConfiguration($configurationId, $data)
    {
        return $this->requestHandler->sendRequestAsync(
            'PATCH',
            sprintf('v7/webhooks/public/api/subscriptions/%s', $configurationId),
            ['json' => $data]
        );
    }

    /**
     * Deletes a webhook configuration.
     *
     * @param string $configurationId
     *
     * @return \GuzzleHttp\Promise\Promise
     * @throws \GuzzleHttp\Exception\RequestException
     */
    public function deleteConfiguration($configurationId)
    {
        return $this->requestHandler->sendRequestAsync(
            'DELETE',
            sprintf('v7/webhooks/public/api/subscriptions/%s', $configurationId)
        );
    }
}
