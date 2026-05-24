<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Sepatu Nayla</title>
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

    <!-- HEADER BANNER -->
    <div style="background: linear-gradient(135deg, #f5d0da, #d4e8d0); padding: 30px 0;">
        <div class="container d-flex align-items-center justify-content-between">
            <div>
                <img src="{{ asset('images/sepatu1.png') }}" style="height:130px;">
            </div>
            <div class="text-center">
                <h1 style="font-family:'Playfair Display',serif; color:#b07080; font-size:2.5rem;">Nayla Shoes</h1>
                <p style="color:#8fac8f; font-size:1rem;">Koleksi Sepatu Cantik & Elegan</p>
            </div>
            <div>
                <img src="{{ asset('images/sepatu2.png') }}" style="height:130px;">
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="page-title"><img src="{{ asset('images/sepatu1.png') }}" style="height:40px;"> Data Sepatu</h4>
            <a href="{{ route('sepatu.create') }}" class="btn btn-tambah">+ Tambah Sepatu</a>
        </div>

    <!-- Search Bar -->
    <form action="{{ route('sepatu.search') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari nama sepatu atau merek..." value="{{ request('keyword') }}">
            <select name="kategori_id" class="form-select" style="max-width:200px;">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-tambah" type="submit">Cari</button>
            <a href="{{ route('sepatu.index') }}" class="btn btn-edit ms-2">Reset</a>
        </div>
    </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Sepatu</th>
                    <th>Merek</th>
                    <th>Kategori</th>
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sepatuss as $index => $sepatu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($sepatu->gambar)
                            <img src="{{ asset('storage/' . $sepatu->gambar) }}" width="60" height="60" class="sepatu-img">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $sepatu->nama_sepatu }}</td>
                    <td>{{ $sepatu->merek }}</td>
                    <td>{{ $sepatu->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $sepatu->ukuran }}</td>
                    <td>{{ $sepatu->warna }}</td>
                    <td>Rp {{ number_format($sepatu->harga, 0, ',', '.') }}</td>
                    <td>{{ $sepatu->stok }}</td>
                    <td>
                        <a href="{{ route('sepatu.edit', $sepatu->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('sepatu.destroy', $sepatu->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>