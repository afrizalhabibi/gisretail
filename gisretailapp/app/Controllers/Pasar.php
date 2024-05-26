<?php

namespace App\Controllers;

use App\Models\PasarModel;
use \Hermawan\DataTables\DataTable;

class Pasar extends BaseController
{
    public function index()
    {
        $PasarModel = new PasarModel();

        return view('/pasar/main_pasar');
    }

    public function showpasar()
    {
        $db = db_connect();
        $builder = $db->table('pasar')
        ->select('id_pasar,nama_pasar,lat,lng,radius');
        
        return DataTable::of($builder)
        ->addNumbering('no')
        ->add('action', function($row){
                return '<button type="button" class="btn btn-light m-1" id="btnedit" data-id="'.$row->id_pasar.'">Ubah</button>
                <button type="button" class="btn btn-light m-1" id="btndelete" data-id="'.$row->id_pasar.'">Hapus</button>';
        })
        ->toJson(true);
    }

    public function addpasar() {
        return view('/pasar/addpasar');
    }

    public function doaddpasar() {
        $db = db_connect();
        $PasarModel = new PasarModel();
        $cleanNumber = preg_replace( '/[^0-9]/', '', microtime(false));

        $data = [
            'id_pasar' => base_convert($cleanNumber, 10, 36),
            'nama_pasar' => $this->request->getPost("add_nama"),
            'lat' => $this->request->getPost("add_lat"),
            'lng' => $this->request->getPost("add_long"),
            'radius' => $this->request->getPost("add_rad"),
        ];
        $save = $db->table('pasar')
                ->set($data)
                ->insert();
        $output = array('status' => 'Terkirim', 'data' => $data);
        return $this->response->setJSON($output);
    }

    public function pasarDetails($id) {
        $PasarModel = new PasarModel();
        $data = [
            'pasar' => $PasarModel->find($id),
        ]; 
        return view('/pasar/editpasar', $data);
    }

    public function doeditpasar() {
        $db = db_connect();
        $PasarModel = new PasarModel();

        $id = $this->request->getPost("edit_id_pasar");
        $data = [
            'nama_pasar' => $this->request->getPost("edit_namapasar"),
            'lat' => $this->request->getPost("edit_lat"),
            'lng' => $this->request->getPost("edit_long"),
            'radius' => $this->request->getPost("edit_rad"),
        ];

        $save = $db->table('pasar')
                   ->set($data)
                   ->where('id_pasar', $id)
                   ->update();
        $output = array('status' => 'Terkirim', 'data' => $data);
        return $this->response->setJSON($output);
    }

    public function dodeletepasar() {
        $db = db_connect();
        $id = $this->request->getPost("delete_id_pasar");

        $delete_pasar = $db->table('pasar')
                            ->where('id_pasar', $id)
                            ->delete();

        $output = array('status' => 'Terhapus', 'data' => $id);
        return $this->response->setJSON($output);
    }
}
