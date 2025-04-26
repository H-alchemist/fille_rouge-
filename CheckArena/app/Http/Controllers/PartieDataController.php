<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Services\SavePatrieServices;

class PartieDataController extends Controller
{


    private $savePatrieServices;

    public function __construct(SavePatrieServices $savePatrieServices)
    {
        $this->savePatrieServices = $savePatrieServices;
    }
    

    public function savePartieData(Request $request)
    {
        $data = $request->all();

     


        $this->savePatrieServices->saveData($data);


  


    }




}
