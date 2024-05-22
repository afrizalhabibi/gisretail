<?php 
namespace App\Models;
use CodeIgniter\Model;

class PemegangModel extends Model {
    protected $table = 'pemegang_retail';
    protected $primaryKey = 'id_pemegang';

    protected $protectFields = true;
    protected $allowedFields = ['id_pemegang','nama','alamat'];

    public function getPemegang() {
        $result = $this->db->table('pemegang_retail')
                ->get();
        return $result;
    }
    
}
?>