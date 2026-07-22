<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Daftar Laporan Kerusakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">🛠️ Dashboard Admin - Daftar Laporan Kerusakan Mesin</h4>
                    <a href="/laporan/baru" class="btn btn-sm btn-light fw-bold">+ Buat Laporan Baru</a>
                </div>
                <div class="card-body">
                    @if(session('sukses'))
                    <div class="alert alert-success fw-bold">{{ session('sukses') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Lokasi (Line)</th>
                                    <th>Section</th>
                                    <th>Komponen</th>
                                    <th>Deskripsi Kerusakan</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporans as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $item->line }}</td>
                                        <td>{{ $item->section }}</td>
                                        <td><span class="badge bg-secondary">{{ $item->komponen }}</span></td>
                                        <td>{{ $item->deskripsi_kerusakan }}</td>
                                        <td class="text-center">
                                            @if($item->foto)
                                                <a href="{{ asset('uploads/' . $item->foto) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Foto</a>
                                            @else
                                                <span class="text-muted small">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <!-- Label status dengan warna berbeda -->
                                            @if($item->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($item->status == 'proses')
                                                <span class="badge bg-info text-dark">Diproses</span>
                                            @else
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.laporan.status', $item->id) }}" method="POST" class="d-flex gap-1 justify-content-center align-items-center">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-select form-select-sm" style="width: 105px;">
                                                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-success fw-bold">OK</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">Belum ada laporan kerusakan yang masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>