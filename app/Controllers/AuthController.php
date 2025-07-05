<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\DiskonModel;

class AuthController extends BaseController
{
    protected $user;
    protected $diskon;

    function __construct() {
        date_default_timezone_set('Asia/Jakarta');
        helper('form');
        $this->user = new UserModel();
        $this->diskon = new DiskonModel();
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $rules = [
                'username' => 'required|min_length[6]',
                'password' => 'required|min_length[7]|numeric',
            ];

            if ($this->validate($rules)) {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                $dataUser = $this->user->where(['username' => $username])->first();

                if ($dataUser && password_verify($password, $dataUser['password'])) {

                    $sessionData = [
                        'username' => $dataUser['username'],
                        'role' => $dataUser['role'],
                        'isLoggedIn' => true,
                        'user_id' => $dataUser['id']
                    ];

                    // Tambahkan diskon jika ada untuk hari ini
                    $diskonHariIni = $this->diskon->where('tanggal', date('Y-m-d'))->first();
                    if ($diskonHariIni) {
                        $sessionData['diskon'] = (float)$diskonHariIni['nominal'];
                    }

                    session()->set($sessionData);
                    return redirect()->to(base_url('/'));
                } else {
                    session()->setFlashdata('failed', 'Kombinasi Username & Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back();
            }
        }

        return view('v_login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
