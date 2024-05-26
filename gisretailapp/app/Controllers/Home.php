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
        $data['retaildata'] = $RetailModel->getretaildata()->getResult();
        return view('home', $data);
    }

    public function retaildata() {
        $RetailModel = new RetailModel();
        $data['retaildata'] = $RetailModel->getretaildata()->getResultArray();

        return $this->response->setJSON($data);
    }
    public function pasardata() {
        $PasarModel = new PasarModel();
        $data['pasardata'] = $PasarModel->getdata()->getResultArray();

        return $this->response->setJSON($data);
    }
}
