<?php

namespace App\Services\Auth;

class LogoutService
{
    protected $session;

    public function __construct()
    {
        $this->session      = \Config\Services::session();
    }

    public function execute(): void
    {
        $this->session->destroy();
    }

    public function check(): bool
    {
        return $this->session->has('is_logged_in') && $this->session->get('is_logged_in') === true;
    }
}
