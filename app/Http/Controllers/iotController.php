<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\device_history;

class iotController extends Controller
{
    public function show(){
        $dataall = DB::table('device_history')
        ->join('device', 'device_history.id_device', '=', 'device.id_device')
        ->select('device_history.*', 'device_history.id as id_history', 'device.*')
        ->where('device.id', Auth::user()->id)
        ->get();
    if ($dataall) {
        return view('admin.IoT.monitoring',compact(['dataall']));
        // return response()->json($dataall);
    } else {
        return view('admin.IoT.monitoring');
    }
    }
    public function destroy($id)
    {
        $dataHistory = device_history::find($id);
        if ($dataHistory) {
            $dataHistory->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }
    public function destroyAll()
    {
        device_history::truncate(); // Menghapus semua data dalam tabel
        return redirect()->back()->with('success', 'Semua history perangkat berhasil dihapus.');
    }
}
