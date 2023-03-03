<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class PengaduanController extends BaseController
{
    protected $pengaduans, $tanggapans;
    public function __construct()
    {
        $this->pengaduans = new Pengaduan();
        $this->tanggapans = new Tanggapan();
    }
    public function index()
    {
        if (session()->get('level') == 'masyarakat') {
            $data['pengaduan'] = $this->pengaduans->where(['nik' => session()->get('nik')])->findAll();
        } else {
            $data['pengaduan'] = $this->pengaduans->findAll();
        }
        return view('pengaduan_view', $data);
    }
    public function save()
    {
        if(!empty($_FILES['foto']['name'])){
            $data = [
                'tgl_pengaduan' => date('Y-m-d H:i:s'),
            'nik' => session()->get('nik'),
            'isi_laporan' => $this->request->getPost('isi_laporan'),
            'foto' => '',
            'status' => '0',

            ];
            
        }else {
            $datafile = $this->request->getfile('foto');
        $filename = $datafile->getRandomName();
        $data = [
            'tgl_pengaduan' => date('Y-m-d H:i:s'),
            'nik' => session()->get('nik'),
            'isi_laporan' => $this->request->getPost('isi_laporan'),
            'foto' => $filename,
            'status' => '0',
        ];
        $datafile->move('upload/berkas', $filename);


        }
        
        $this->pengaduans->insert($data);
        return redirect('pengaduan');
    }
    public function delete($id)
    {
        $this->pengaduans->delete($id);
        return redirect('pengaduan');
    }
}
