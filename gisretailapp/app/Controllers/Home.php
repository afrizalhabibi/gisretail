<?php

namespace App\Controllers;

use App\Models\RetailModel;
use App\Models\PasarModel;
use \Hermawan\DataTables\DataTable;

class Home extends BaseController
{
    public function index()
    {
        $RetailModel = new RetailModel();
        $data = [
            'retaildata' => $RetailModel->getretaildata()->getResult(),
            'kecamatan' => $RetailModel->getkecdata()->getResultArray(),
        ];
        return view('home', $data);
    }

    public function retaildata() {
        $RetailModel = new RetailModel();
        $data['retaildata'] = $RetailModel->getretaildata()->getResultArray();

        return $this->response->setJSON($data);
    }
    public function retaildatafilter() {
        $id_kec = $this->request->getPost('id_kec');
        $RetailModel = new RetailModel();
        $data['retaildatakec'] = $RetailModel->getretaildatakec($id_kec)->getResultArray();

        return $this->response->setJSON($data);
    }
    public function pasardata() {
        $PasarModel = new PasarModel();
        $data['pasardata'] = $PasarModel->getdata()->getResultArray();

        return $this->response->setJSON($data);
    }
}
