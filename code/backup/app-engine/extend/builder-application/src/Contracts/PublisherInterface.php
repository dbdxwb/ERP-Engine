<?php

namespace Builder\Application\Contracts;

interface PublisherInterface
{
    /**
     * Publish something.
     *
     * @return mixed
     */
    public function publish();
}
