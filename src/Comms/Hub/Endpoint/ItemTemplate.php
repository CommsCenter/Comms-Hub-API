<?php namespace Comms\Hub\Endpoint;

use Pckg\Api\Endpoint;

class ItemTemplate extends Endpoint
{

    /**
     * @var string
     */
    protected $path = 'item-template';

    public function getAll()
    {
        return $this->getAndDataResponse(null, 'templates');
    }

    public function publishItemTemplate($data)
    {
        d($data);
    }

}