<?php

namespace App\Controllers;

use App\Models\RetailModel;
use \Hermawan\DataTables\DataTable;

class Retail extends BaseController
{
    public function index()
    {
        return view('/retail/main');
    }

    public function showretail()
    {
        $db = db_connect();
        $builder = $db->table('retail')->select('id_retail, id_pemegang,nama_retail,alamat,status,kecamatan,latitude,longitude');
        
        return DataTable::of($builder)->toJson();
    }

    public function cleannumber() {
        $cleanNumber = preg_replace( '/[^0-9]/', '', microtime(false));

        return(base_convert($cleanNumber, 10, 36));
    }
}
