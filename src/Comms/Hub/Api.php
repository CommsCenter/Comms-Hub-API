<?php namespace Comms\Hub;

use Comms\Hub\Endpoint\ItemTemplate;
use Comms\Hub\Endpoint\Share;
use GuzzleHttp\RequestOptions;
use Pckg\Api\Api as PckgApi;

/**
 * Class Api
 *
 * @package CommsCenter\Comms
 */
class Api extends PckgApi
{

    /**
     * Api constructor.
     *
     * @param $endpoint
     * @param $apiKey
     */
    public function __construct($endpoint, $apiKey)
    {
        $this->endpoint = $endpoint;
        $this->apiKey = $apiKey;

        $this->requestOptions = [
            RequestOptions::HEADERS => [
                'X-Comms-Hub-Api-Key' => $this->apiKey,
            ],
            RequestOptions::TIMEOUT => 15,
        ];
    }

    /**
     * @param array $data
     *
     * @return ItemTemplate
     */
    public function share($data = [])
    {
        return new Share($this, $data);
    }

}