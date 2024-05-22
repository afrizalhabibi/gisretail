<?php

namespace App\Controllers;

use App\Models\RetailModel;
use App\Models\PemegangModel;
use \Hermawan\DataTables\DataTable;

class Retail extends BaseController
{
    public function index()
    {
        $PemegangModel = new PemegangModel();
        $RetailModel = new RetailModel();
        $data = [
            'retaildata' => $RetailModel->getStatus()->getResult(),
            'kecamatan' => $RetailModel->getkecdata()->getResult(),
            'pemegang' => $PemegangModel->getPemegang()->getResult(),
        ]; 

        return view('/retail/main', $data);
    }

    public function showretail()
    {
        $db = db_connect();
        $builder = $db->table('retail')
        ->select('retail.id_retail,nama,nama_retail,retail.alamat,status,kecamatan,latitude,longitude')
        ->join('pemegang_retail', 'pemegang_retail.id_pemegang = retail.id_pemegang')
        ->join('kecamatan', 'kecamatan.id_kec = retail.id_kec');
        
        return DataTable::of($builder)
        ->addNumbering('no')
        ->add('action', function($row){
                return '<button type="button" class="btn btn-light m-1" id="btnedit" data-id="'.$row->id_retail.'">Ubah</button>
                <button type="button" class="btn btn-light m-1" id="btndelete" data-id="'.$row->id_retail.'">Hapus</button>';
        })
        ->filter(function($builder, $request) {
            if ($request->izin && $request->status == null && $request->kecamatan == null) {
                $builder->where('retail.id_pemegang', $request->izin);
            } elseif ($request->izin == null && $request->status && $request->kecamatan == null) {
                $builder->where('retail.status', $request->status);
            } elseif ($request->izin == null && $request->status == null && $request->kecamatan) {
                $builder->where('retail.id_kec', $request->kecamatan);
            } elseif ($request->izin && $request->status && $request->kecamatan == null) {
                $builder->where('retail.status', $request->status);
                $builder->where('retail.id_pemegang', $request->izin);
            } elseif ($request->izin && $request->status == null && $request->kecamatan) {
                $builder->where('retail.id_pemegang', $request->izin);
                $builder->where('retail.id_kec', $request->kecamatan);
            } elseif ($request->izin == null && $request->status && $request->kecamatan) {
                $builder->where('retail.status', $request->status);
                $builder->where('retail.id_kec', $request->kecamatan);
            }
        })
        ->toJson(true);
    }

    public function retailDetails($id) {
        $PemegangModel = new PemegangModel();
        $RetailModel = new RetailModel();
        $data = [
            'retail' => $RetailModel->find($id),
            'kecamatan' => $RetailModel->getkecdata()->getResultArray(),
            'pemegang' => $PemegangModel->getPemegang()->getResultArray(),
        ]; 
        // $this->response->setJSON($data);
        return view('/retail/editretail', $data);
    }

    public function addretail() {
        $PemegangModel = new PemegangModel();
        $RetailModel = new RetailModel();
        $data = [
            'kecamatan' => $RetailModel->getkecdata()->getResultArray(),
            'pemegang' => $PemegangModel->getPemegang()->getResultArray(),
        ] ;
        return view('/retail/addretail', $data);
    }

    public function doaddretail() {
        $db = db_connect();
        $RetailModel = new RetailModel();
        $cleanNumber = preg_replace( '/[^0-9]/', '', microtime(false));

        $data = [
            'id_retail' => base_convert($cleanNumber, 10, 36),
            'id_pemegang' => $this->request->getPost("add_pemegang"),
            'nama_retail' => $this->request->getPost("add_nama"),
            'status' => $this->request->getPost("add_status"),
            'alamat' => $this->request->getPost("add_alamat"),
            'id_kec' => $this->request->getPost("add_kec"),
            'latitude' => $this->request->getPost("add_lat"),
            'longitude' => $this->request->getPost("add_long"),
        ];
        $save = $db->table('retail')
                ->set($data)
                ->insert();
        $output = array('status' => 'Terkirim', 'data' => $data);
        return $this->response->setJSON($output);
    }

    public function doeditretail() {
        $db = db_connect();
        $RetailModel = new RetailModel();

        $id = $this->request->getPost("edit_id_retail");
        $data = [
            'id_pemegang' => $this->request->getPost("edit_pemegang"),
            'id_kec' => $this->request->getPost("edit_kec"),
            'nama_retail' => $this->request->getPost("edit_nama"),
            'alamat' => $this->request->getPost("edit_alamat"),
            'status' => $this->request->getPost("edit_status"),
            'latitude' => $this->request->getPost("edit_lat"),
            'longitude' => $this->request->getPost("edit_long"),
        ];

        $save = $db->table('retail')
                   ->set($data)
                   ->where('id_retail', $id)
                   ->update();
        $output = array('status' => 'Terkirim', 'data' => $data);
        return $this->response->setJSON($output);
    }

    public function dodeleteretail() {
        $db = db_connect();
        $id = $this->request->getPost("delete_id_retail");

        $delete_retail = $db->table('retail')
                            ->where('id_retail', $id)
                            ->delete();

        $output = array('status' => 'Terhapus', 'data' => $id);
        return $this->response->setJSON($output);
    }

    public function cleannumber() {
        $cleanNumber = preg_replace( '/[^0-9]/', '', microtime(false));

        return(base_convert($cleanNumber, 10, 36));
    }
}
