<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    //kolom yang boleh diisi secara massal
    protected $fillable = ['nama_kelas', 'wali_kelas'];

    //relasi: satu kelas punya banyak siswa
    public function siswa(){
        return $this->hasMany(Siswa::class);
    }
}
