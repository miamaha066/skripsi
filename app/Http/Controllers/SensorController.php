<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function Sensor(){
        $sensor = Sensor::all();
        return view('dataSensor')->with('sensor',$sensor);
    }

    public function Riwayat(){
        $sensor = Riwayat::all();
        return view('riwayat_monitoring')->with('sensor',$sensor);
    }

    public function CekSuhu(){
        return view('cekSuhu');
    }

    public function CekKelembaban(){
        return view('cekKelembaban');
    }
}
