<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
         return view('supplier.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        // 2. Simpan
        \App\Models\Supplier::create($request->all());

        // 3. Redirect
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function show(Supplier $supplier)
    {
        //
    }

        public function edit($id)
    {
        $supplier = \App\Models\Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        \App\Models\Supplier::findOrFail($id)->update($request->all());
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate!');
    }

    public function destroy($id)
    {
        \App\Models\Supplier::findOrFail($id)->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }
}