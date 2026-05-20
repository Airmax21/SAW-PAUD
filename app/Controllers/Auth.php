<?php

namespace App\Controllers;

use App\Services\Auth\CheckAuthService;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;

class Auth extends BaseController
{
    protected $loginService, $logoutService, $checkAuthService;

    public function __construct()
    {
        $this->loginService = new LoginService();
        $this->logoutService = new LogoutService();
        $this->checkAuthService = new CheckAuthService();
    }

    public function login()
    {
        // Jika sudah login, tendang langsung ke halaman dashboard/ranking
        if ($this->checkAuthService->execute()) {
            return redirect()->to('dashboard');
        }

        return view('pages/auth/login', ['title' => 'Login Guru']);
    }

    public function authenticate()
    {
        // Controller untuk login
        $username = $this->request->getPost('username') ?? '';
        $password = $this->request->getPost('password') ?? '';

        if ($this->loginService->execute($username, $password)) {
            return redirect()->to('ranking')->with('success', 'Selamat datang kembali, Ibu/Bapak Guru!');
        }

        return redirect()->back()->withInput()->with('errors', ['Username atau password salah.']);
    }

    public function logout()
    {
        // Controller untuk logout
        $this->logoutService->execute();
        return redirect()->to('login')->with('success', 'Berhasil keluar sistem.');
    }
}
