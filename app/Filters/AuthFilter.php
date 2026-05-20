<?php

namespace App\Filters;

use App\Services\Auth\CheckAuthService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $checkAuthService = new CheckAuthService();

        // Jika belum login, paksa ke halaman login
        if (!$checkAuthService->execute()) {
            return redirect()->to('login')->with('errors', ['Silakan masuk terlebih dahulu untuk mengakses aplikasi.']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
