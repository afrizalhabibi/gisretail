<?php

namespace App\Controllers;

use App\Models\RetailModel;
use \Hermawan\DataTables\DataTable;

class Home extends BaseController
{
    public function index()
    {
        $RetailModel = new RetailModel();
        $data['retaildata'] = $RetailModel->getretaildata()->getResult();
        return view('home', $data);
    }
}
