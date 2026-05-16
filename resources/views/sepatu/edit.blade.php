<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sepatu - Toko Sepatu Nayla</title>
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
            <h4 class="page-title"><img src="{{ asset('images/sepatu1.png') }}" style="height:40px;"> Edit Sepatu</h4>
            <a href="{{ route('sepatu.index') }}" class="btn btn-tambah">Kembali</a>
        </div>

        <div class="card p-4">
            <form action="{{ route('sepatu.update', $sepatu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $sepatu->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Sepatu</label>
                    <input type="text" name="nama_sepatu" class="form-control" value="{{ $sepatu->nama_sepatu }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Merek</label>
                    <input type="text" name="merek" class="form-control" value="{{ $sepatu->merek }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ukuran</label>
                    <input type="number" name="ukuran" class="form-control" value="{{ $sepatu->ukuran }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Warna</label>
                    <input type="text" name="warna" class="form-control" value="{{ $sepatu->warna }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="{{ $sepatu->harga }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ $sepatu->stok }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    @if($sepatu->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $sepatu->gambar) }}" width="80" height="80" class="sepatu-img">
                        </div>
                    @endif
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                </div>
                <button type="submit" class="btn btn-tambah">Update</button>
            </form>
        </div>
    </div>
</body>
</html>