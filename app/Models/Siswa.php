<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nis',
        'nama_lengkap',
        'jenis_kelamin',
        'alamat',
        'tanggal_lahir',
        'kelas_id'
    ];
    // Relasi: Satu Siswa milik satu Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
