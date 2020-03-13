<?php namespace Comms\Hub\Endpoint;

use Pckg\Api\Endpoint;

class Share extends Endpoint
{

    /**
     * @var string
     */
    protected $path = 'shares';

    public function getAll()
    {
        return $this->getAndDataResponse(null, 'shares');
    }

    public function publishItemTemplate($data)
    {
        d($data);
    }

}