<?php

namespace App\Http\Controllers;

use App\Models\Sepatu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SepatuController extends Controller
{
    // Menampilkan data menggunakan Eloquent
    public function index()
    {
    $sepatuss = Sepatu::with('kategori')->get();
    $kategoris = Kategori::all();
    return view('sepatu.index', compact('sepatuss', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('sepatu.create', compact('kategoris'));
    }

    // Menambah data menggunakan Eloquent create()
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

        // Eloquent create()
        Sepatu::create($data);
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil ditambahkan!');
    }

    // Mencari data menggunakan Eloquent find()
    public function edit($id)
    {
        $sepatu = Sepatu::find($id);
        $kategoris = Kategori::all();
        return view('sepatu.edit', compact('sepatu', 'kategoris'));
    }

    // Mengupdate data menggunakan Eloquent update()
    public function update(Request $request, $id)
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

        // Eloquent find()
        $sepatu = Sepatu::find($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($sepatu->gambar) {
                Storage::disk('public')->delete($sepatu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sepatu', 'public');
        }

        // Eloquent update()
        $sepatu->update($data);
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil diupdate!');
    }

    // Mencari data menggunakan Eloquent where()
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $kategori_id = $request->kategori_id;

        $sepatuss = Sepatu::with('kategori')
            ->when($keyword, function($query) use ($keyword) {
                $query->where('nama_sepatu', 'like', '%'.$keyword.'%')
                    ->orWhere('merek', 'like', '%'.$keyword.'%');
            })
            ->when($kategori_id, function($query) use ($kategori_id) {
                $query->where('kategori_id', $kategori_id);
            })
            ->get();

        $kategoris = Kategori::all();
        return view('sepatu.index', compact('sepatuss', 'kategoris'));
    }

    // Menghapus data menggunakan Eloquent delete()
    public function destroy($id)
    {
        $sepatu = Sepatu::find($id);
        if ($sepatu->gambar) {
            Storage::disk('public')->delete($sepatu->gambar);
        }
        // Eloquent delete()
        $sepatu->delete();
        return redirect()->route('sepatu.index')->with('success', 'Sepatu berhasil dihapus!');
    }
}