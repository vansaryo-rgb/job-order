<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Laporan Kerusakan Mesin</title>
    <!-- Kita pakai Bootstrap (style instan) agar tampilannya langsung rapi dan bagus -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-danger text-white text-center">
            <h4 class="mb-0">Form Laporan Kerusakan Mesin</h4>
        </div>
        <div class="card-body p-4">

            @if(session('sukses'))
            <div class="alert alert-success fw-bold">{{ session('sukses') }}</div>
            @endif

            <form action="{{ route('laporan.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- 1. Pilihan Opsi Level 1 (Line) -->
                <div class="mb-3">
                    <label class="form-label fw-bold">1. Pilih Lokasi (Line)</label>
                    <select name="line" class="form-select" required>
                        <option value="">-- Pilih Line --</option>
                        <option value="Line A">Line A</option>
                        <option value="Line B">Line B</option>
                        <option value="Line C">Line C</option>
                    </select>
                </div>

                <!-- 2. Pilihan Opsi Level 2 (Section) -->
                <div class="mb-3">
                    <label class="form-label fw-bold">2. Pilih Bagian (Section)</label>
                    <select name="section" class="form-select" required>
                        <option value="">-- Pilih Section --</option>
                        <option value="Mixing">Mixing (Pencampuran)</option>
                        <option value="Cutting">Cutting (Pemotongan)</option>
                        <option value="Oven">Oven (Pemanggangan)</option>
                    </select>
                </div>

                <!-- 3. Pilihan Jenis Komponen -->
                <div class="mb-3">
                    <label class="form-label fw-bold">3. Pilih Jenis Komponen</label>
                    <select name="komponen" class="form-select" required>
                        <option value="">-- Pilih Komponen --</option>
                        <option value="Servo">Servo</option>
                        <option value="Motor">Motor</option>
                        <option value="Listrik">Listrik</option>
                        <option value="Bearing">Bearing</option>
                        <option value="V-Belt">V-Belt</option>
                        <option value="Seal">Seal</option>
                    </select>
                </div>

                <!-- 4. Keterangan Detail Kerusakan -->
                <div class="mb-3">
                    <label class="form-label fw-bold">4. Detail Kerusakan (Keterangan)</label>
                    <textarea name="deskripsi_kerusakan" class="form-control" rows="4" placeholder="Jelaskan detail kerusakan di sini... Contoh: AC Bocor air atau Bearing Pecah" required></textarea>
                </div>

                <!-- 5. Upload Foto Kerusakan -->
                <div class="mb-3">
                    <label class="form-label fw-bold">5. Upload Foto Kerusakan (Opsional)</label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" accept="image/*" capture="camera">
                    <div class="form-text">Ambil foto komponen yang bermasalah agar mekanik lebih jelas.</div>
                </div>

                <hr>

                <!-- Tombol Kirim -->
                <button type="submit" class="btn btn-danger w-100 fw-bold py-2">KIRIM LAPORAN KE ADMIN</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>