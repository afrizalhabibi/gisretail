<?php 
namespace App\Models;
use CodeIgniter\Model;

class PasarModel extends Model {
    protected $table = 'pasar';
    protected $primaryKey = 'id_pasar';

    protected $protectFields = true;
    protected $allowedFields = ['id_pasar','nama_pasar','lat','lng','radius'];

    public function getdata() {
        $result = $this->db->table('pasar')
        ->get();

        return $result;
    }
}
?>