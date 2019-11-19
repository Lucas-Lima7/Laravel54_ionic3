<?php

namespace DeskFlix\Listeners;

use DeskFlix\PayPal\WebProfileClient;
use Prettus\Repository\Events\RepositoryEntityCreated;

class CreatePayPalWebProfileListener
{
    /**
     * @var WebProfileClient
     */
    private $webProfileClient;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(WebProfileClient $webProfileClient)
    {
        //
        $this->webProfileClient = $webProfileClient;
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEntityCreated  $event
     * @return void
     */
    public function handle(RepositoryEntityCreated $event)
    {
        //
    }
}
