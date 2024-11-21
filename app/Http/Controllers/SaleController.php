<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        // Mendapatkan semua data penjualan
        $sales = Sale::all();
        return view('admin.rekap.rekap_penjualan', compact('sales'));
    }

    public function create()
    {
        return view('admin.rekap.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required',
            'sale_date' => 'required|date',
            'quantity' => 'required|integer',
            'rabbit_type' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
        ]);

        Sale::create($request->all());
        return redirect()->route('sales.index')->with('success', 'Sale record created successfully.');
    }

    public function edit(Sale $sale)
    {
        return view('admin.rekap.edit', compact('sale'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'buyer_name' => 'required',
            'sale_date' => 'required|date',
            'quantity' => 'required|integer',
            'rabbit_type' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
        ]);

        $sale->update($request->all());
        return redirect()->route('sales.index')->with('success', 'Sale record updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale record deleted successfully.');
    }
}
