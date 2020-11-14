<?php


namespace validators;


use Services\SessionService;

class AbstractValidator
{
    /**
     * @var SessionService
     */
    protected $sessionService;

    /**
     * AbstractValidator constructor.
     */
    public function __construct()
    {
        $this->sessionService = new SessionService();
    }
}