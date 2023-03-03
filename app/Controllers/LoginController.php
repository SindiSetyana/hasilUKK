<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Masyarakat;
use App\Models\Petugas;

class LoginController extends BaseController
{
    protected $masyarakats;
    function __construct()
    {
        $this->masyarakats = new Masyarakat();
    }
    public function index()
    {
        return view('login_view');
    }
    public function register()
    {
        return view('register_view');
    }
    public function saveRegister()
    {
        $ceknik = $this->masyarakats->where('nik', $this->request->getPost('nik'))->findAll();
        if ($ceknik == null) {
            $data = array(
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password') . "", PASSWORD_DEFAULT),
                'telp' => $this->request->getPost('telp'),
            );
            $this->masyarakats->insert($data);
            return redirect('login');
        } else {
            return redirect('register')->with('nik', lang('NIK Sudah Ada!!'));
        }
    }
    public function login()
    {
        $masy = new Masyarakat();
        $petugas = new Petugas();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password') . "";
        $cekmasy = $masy->where(['username' => $username])->first();
        $cekpetugas = $petugas->where(['username' => $username])->first();
        if (!($cekmasy) && !($cekpetugas)) {
            return redirect('login')->with("error", lang('Username Tidak Ditemukan'));
        } else {
            if ($cekmasy) {
                if (password_verify($password, $cekmasy['password'])) {
                    session()->set([
                        'nik' => $cekmasy['nik'],
                        'nama' => $cekmasy['nama'],
                        'level' => 'masyarakat',
                        'log_in' => true,
                    ]);
                    return redirect('/');
                } else {
                    return redirect('login')->with("error", lang('Password Masyarakat Salah'));
                }
            }
        }
        if ($cekpetugas) {
            if (password_verify($password, $cekpetugas['password'])) {
                session()->set([
                    'id_petugas' => $cekpetugas['id_petugas'],
                    'nama_petugas' => $cekpetugas['nama_petugas'],
                    'level' => $cekpetugas['level'],
                    'log_in' => true,
                ]);
                return redirect('/');
            } else {
                return redirect('login')->with("error", lang('Password Petugas Salah'));
            }
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return $this->response->redirect('login');
    }
}
