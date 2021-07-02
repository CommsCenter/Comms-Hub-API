<?php namespace Comms\Hub\Endpoint;

use Pckg\Api\Endpoint;

class Store extends Endpoint
{

    /**
     * @var string
     */
    protected $path = 'stores';

    public function connect(string $token, string $publicKey)
    {
        return !!$this->getApi()
            ->request('POST', 'api/store/connect', [
                'identifier' => $this->identifier,
                'token' => $token,
                'publicKey' => $publicKey,
            ])
            ->getApiResponse('success');
    }
}
