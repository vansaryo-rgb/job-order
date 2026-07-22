<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    // 🔓 Membuka izin agar kolom-kolom ini bisa diisi oleh form input
    protected $fillable = [
        'user_id', 
        'line', 
        'section', 
        'komponen', 
        'deskripsi_kerusakan', 
        'foto', 
        'status'
    ];
}