<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    // Menampilkan dashboard
    public function index()
    {
        $yourDevice = Device::where('id', Auth::user()->id)->get();
        $suhu = Device::select('id_device', 'nama_device', 'maks_suhu', 'min_suhu')->get();

        return view('admin.dashboard', compact(['yourDevice', 'suhu']));
    }

    // Menambahkan device
    public function add(Request $request)
    {
        $validated = $request->validate([
            'id_device' => 'required|string|max:255|unique:device,id_device',
            'password' => 'required|string|max:255',
            'nama_device' => 'required|string|max:255',
            'max_temp' => 'integer|min:0|max:1000', // example range
            'min_temp' => 'integer|min:0|max:1000', // example range


        ]);

        $device = new Device();
        $device->id = Auth::user()->id;
        $device->id_device = $validated['id_device'];
        $device->nama_device = $validated['nama_device'];
        $device->password = $validated['password'];
        $device->maks_suhu = $validated['max_temp'];
        $device->min_suhu = $validated['min_temp'];
        $device->status = 0;
        $device->save();

        return redirect()->route('admin.dashboard')->with('success', 'Device added successfully');
    }

    // Mengedit device
    public function edit(Request $request)
    {
        $validated = $request->validate([
            'id_device' => 'required|string|max:255|exists:device,id_device',
            'nama_device' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            // 'status' => 'required|integer|in:0,1',
            'max_temp' => 'integer|min:0|max:1000', // example range
            'min_temp' => 'integer|min:0|max:1000', // example range
        ]);

        $device = Device::where('id_device', $validated['id_device'])->first();

        if (!$device || $device->id !== Auth::user()->id) {
            return redirect()->back()->withErrors('Unauthorized action or device not found.');
        }

        $device->id_device = $validated['id_device'];
        $device->nama_device = $validated['nama_device'];
        $device->password = $validated['password'];
        // $device->status = $validated['status'];
        $device->maks_suhu = $validated['max_temp'];
        $device->min_suhu = $validated['min_temp'];
        $device->save();

        return redirect()->route('admin.dashboard')->with('success', 'Device updated successfully');
    }

    public function delete(Request $request)
    {

        $request->validate([
            'id' => 'required|string|max:255|exists:device,id_device',
        ]);

        $device = Device::where('id_device', '=', $request->id)->first();
        // dd($device);
        if (!$device) {
            return redirect()->back()->withErrors('Unauthorized action or device not found.');
        }

        $device->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Device deleted successfully');
    }
}
