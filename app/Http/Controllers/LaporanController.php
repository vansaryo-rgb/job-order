<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Fungsi untuk memproses data yang dikirim dari form
    public function simpan(Request $request)
    {
        // 1. Validasi data agar inputan tidak boleh kosong
        $request->validate([
            'line' => 'required',
            'section' => 'required',
            'komponen' => 'required',
            'deskripsi_kerusakan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Batasan foto maks 2MB
        ]);

        // 2. Siapkan data yang akan dimasukkan ke database
        $data = $request->all();
        
        // 💡 Catatan Sementara: Karena kita belum membuat sistem Login User,
        // kita isi user_id otomatis dengan angka 1 dulu agar tidak eror.
        $data['user_id'] = 1; 

        // 3. Proses upload foto jika user mengunggah foto
        if ($request->hasFile('foto')) {
            $namaFoto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $namaFoto);
            $data['foto'] = $namaFoto; // Simpan nama filenya saja ke database
        }

        // 4. Masukkan semua data ke tabel laporans di MySQL
        Laporan::create($data);

        // 5. Kembalikan ke halaman form dengan pesan sukses
        return redirect()->back()->with('sukses', 'Laporan kerusakan berhasil dikirim ke Admin!');
    }

    // Fungsi untuk menampilkan daftar laporan di halaman Admin
    public function index()
    {
        // Ambil semua data laporan dari database, urutkan dari yang paling baru
        $laporans = Laporan::latest()->get(); 

        // Kirim data tersebut ke file tampilan admin
        return view('admin_laporan', compact('laporans'));
    }

    // Fungsi untuk memperbarui status laporan oleh admin
    public function updateStatus(Request $request, $id)
    {
        // Cari data laporan berdasarkan ID-nya
        $laporan = Laporan::findOrFail($id);

        // Update status sesuai pilihan dari admin
        $laporan->update([
            'status' => $request->status
        ]);

        // Kembalikan ke halaman admin dengan pesan sukses
        return redirect()->back()->with('sukses', 'Status laporan berhasil diperbarui!');
    }
}