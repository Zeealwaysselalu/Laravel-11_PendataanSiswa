<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // READ (Daftar Siswa)
    public function index()
    {
        // Ambil data siswa DAN data kelas terkait (Eager Loading)
        $dataSiswa = Siswa::with('kelas')->get();
        return view('siswa.index', ['semuaSiswa' => $dataSiswa]);
    }
    // CREATE (Form Tambah)
    public function create()
    {
        // Ambil semua data kelas untuk ditampilkan di dropdown
        $dataKelas = Kelas::all();
        return view('siswa.create', ['semuaKelas' => $dataKelas]);
    }
    // STORE (Proses Simpan)
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:siswa,nis|max:10',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);
        Siswa::create($request->all());
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil
ditambahkan.');
    }
    // SHOW (Detail) - Boleh diskip
    public function show(Siswa $siswa)
    {
        //
    }
    // EDIT (Form Ubah)
    public function edit(Siswa $siswa)
    {
        $dataKelas = Kelas::all(); // Data kelas untuk dropdown
        return view('siswa.edit', [
            'siswa' => $siswa,
            'semuaKelas' => $dataKelas
        ]);
    }
    // UPDATE (Proses Ubah)
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|string|max:10|unique:siswa,nis,' . $siswa->id,
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);
        $siswa->update($request->all());
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diubah.');
    }
    // DELETE (Proses Hapus)
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
