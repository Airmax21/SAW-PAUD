<?php

namespace App\Services\Auth;

class CheckAuthService
{
    protected $session;

    public function __construct()
    {
        $this->session= \Config\Services::session();
    }

    public function execute(): bool
    {
        return $this->session->has('is_logged_in') && $this->session->get('is_logged_in') === true;
    }
}
