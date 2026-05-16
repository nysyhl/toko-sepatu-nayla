<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sepatu - Toko Sepatu Nayla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" style="width:50px; height:50px; object-fit:cover; margin-right:10px;"> Nayla Shoes
        </a>
        <div class="ms-auto">
            <a href="{{ route('sepatu.index') }}" class="btn btn-nav me-2">Data Sepatu</a>
            <a href="{{ route('kategori.index') }}" class="btn btn-nav">Kategori</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="page-title"><img src="{{ asset('images/sepatu1.png') }}" style="height:40px;"> Tambah Sepatu</h4>
            <a href="{{ route('sepatu.index') }}" class="btn btn-tambah">Kembali</a>
        </div>

        <div class="card p-4">
            <form action="{{ route('sepatu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Sepatu</label>
                    <input type="text" name="nama_sepatu" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Merek</label>
                    <input type="text" name="merek" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ukuran</label>
                    <input type="number" name="ukuran" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Warna</label>
                    <input type="text" name="warna" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-tambah">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>