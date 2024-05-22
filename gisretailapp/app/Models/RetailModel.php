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
        ->join('kecamatan', 'kecamatan.id_kec = retail.id_kec')
        ->get();

        return $result;
    }
    public function getStatus() {
        $result = $this->db->table('retail')
        ->groupBy('status')
        ->get();

        return $result;
    }

    public function getkecdata() {
        $result = $this->db->table('kecamatan')
        ->get();

        return $result;
    }
    
    public function getretailbyid($id) {
        $result = $this->db->table('retail')
        ->where('id_retail', $id)
        ->get();

        return $result->getRow();
    }
}
?>