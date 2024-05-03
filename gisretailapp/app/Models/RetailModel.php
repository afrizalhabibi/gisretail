<?php 
namespace App\Models;
use CodeIgniter\Model;

class RetailModel extends Model {
    protected $table = 'retail';
    protected $primaryKey = 'id_retail';

    protected $protectFields = true;
    protected $allowedFields = ['id_retail','id_pemegang','nama_retail','alamat','status','kecamatan','latitude','longitude'];

    public function getretaildata() {
        $result = $this->db->table('retail')
        ->get();

        return $result;
    }
}
?>