<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
class TanggapanController extends BaseController{
    protected $pengaduans,$tanggapans;
    public function __construct()
    {
        $this->pengaduans = new Pengaduan();
        $this->tanggapans = new Tanggapan();
    }
    public function simpan()
    {
        $data = [
            'tgl_tanggapan'=> date('Y-m-d H:i:s'),
            'id_petugas' => session()->get('id_petugas'),
            'tanggapan' => $this->request->getPost('tanggapan'),
            'id_pengaduan' => $this->request->getPost('id_pengaduan'),
        ]; 
        $this->tanggapans->insert($data);
        $this->pengaduans->set('status','SELESAI');
        $this->pengaduans->where('id_pengaduan', $this->request->getPost('id_pengaduan'));
        $this->pengaduans->update();
        return redirect('pengaduan');
    }
    public function getTanggapan()
    {
        $data=$this->tanggapans->where('id_pengaduan', $this->request->getGet('id_pengaduan'))->findAll();
        return response()->setJSON($data);
    }

}