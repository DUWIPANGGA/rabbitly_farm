<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class iotController extends Controller
{
    public function show(){
        $dataall = DB::select('
        SELECT device_history.*, device.*
        FROM device_history
        INNER JOIN device ON device_history.id_device = device.id_device
        WHERE device.id = ?
    ', [Auth::user()->id]);
    if ($dataall) {
        return view('admin.IoT.monitoring',compact(['dataall']));
        // return response()->json($dataall);
    } else {
        return view('admin.IoT.monitoring');
    }
    }
}
