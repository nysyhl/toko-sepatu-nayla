<?php

namespace App\Http\Controllers;

use App\Models\Sepatu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SepatuController extends Controller
{
    public function index()
    {
        $sepatuss = Sepatu::with('kategori')->get();
        return view('sepatu.index', compact('sepatuss'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('sepatu.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_sepatu' => 'required',
            'merek' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sepatu', 'public');
        }

        Sepatu::create($data);
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil ditambahkan!');
    }

    public function edit(Sepatu $sepatu)
    {
        $kategoris = Kategori::all();
        return view('sepatu.edit', compact('sepatu', 'kategoris'));
    }

    public function update(Request $request, Sepatu $sepatu)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_sepatu' => 'required',
            'merek' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($sepatu->gambar) {
                Storage::disk('public')->delete($sepatu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sepatu', 'public');
        }

        $sepatu->update($data);
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil diupdate!');
    }

    public function destroy(Sepatu $sepatu)
    {
        if ($sepatu->gambar) {
            Storage::disk('public')->delete($sepatu->gambar);
        }
        $sepatu->delete();
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil dihapus!');
    }
}