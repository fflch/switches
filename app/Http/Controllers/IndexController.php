<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamento;
use App\Models\Mac;
use Uspdev\Utils\Generic;

class IndexController extends Controller
{

    public function index(Request $request){

        if(isset($request->search)) {
            $this->authorize('user');
            $mac = strtoupper($request->search);
            $macs = Mac::where('mac','LIKE',"%{$mac}%")->paginate(30);
            return view('macs.index',[
                'macs' => $macs, 
            ]);
        }

        return view('index',[
           'locais' => Equipamento::all()->groupBy('local'), 
        ]);
    }
}
