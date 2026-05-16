<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sepatu extends Model
{
    protected $table = 'sepatuss';
    protected $fillable = [
        'kategori_id',
        'nama_sepatu',
        'merek',
        'ukuran',
        'warna',
        'harga',
        'stok',
        'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}