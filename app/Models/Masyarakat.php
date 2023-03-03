<?php 
namespace App\Models;

use CodeIgniter\Model;

class Masyarakat extends Model{
    protected $table      = 'tb_masyarakat';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['nik','nama','username','password','telp'];

    // protected $useSoftDeletes = true;
    // protected $deletedField ='deleted_at';
}