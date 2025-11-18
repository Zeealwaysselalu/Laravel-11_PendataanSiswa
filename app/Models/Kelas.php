<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'wali_kelas'];
    
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
