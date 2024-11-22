<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\device_history;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    public function getDevices()
    {
        $devices = Device::where('id', Auth::user()->id)->get();

        return response()->json($devices);
    }
    public function saveState(Request $request)
    {
        $request->validate([
            'ID' => 'required|string',        // ID untuk mencari device
            'pass' => 'required|string',      // Password perangkat
            'state' => 'required|boolean',    // State perangkat (on/off)
        ]);
        // Cari device berdasarkan ID
        $device = Device::where('id_device', '=', $request->ID)->first();

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        // Periksa validitas password
        if ($device->password != $request->pass) {
            return response()->json(['message' => 'Invalid password'], 401);
        }
        device_history::create([
            'id_device' => $request->ID,
            'status_lampu' => $request->state,
        ]);
        $dataall = DB::select('
        SELECT device_history.*, device.*
        FROM device_history
        INNER JOIN device ON device_history.id_device = device.id_device
        WHERE device.id = ?
    ', [Auth::user()->id]);

        // Jika data ditemukan, kembalikan data, jika tidak, bisa memberi respon lainnya
        if ($dataall) {
            return response()->json($dataall);
        } else {
            return response()->json(['message' => 'No records found'], 404);
        }
    }
}
