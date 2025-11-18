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

        return view('siswa.index', [
            'semuaSiswa' => $dataSiswa
        ]);
    }

    // CREATE (Form Tambah)
    public function create()
    {
        // Ambil semua data kelas untuk dropdown
        $dataKelas = Kelas::all();

        return view('siswa.create', [
            'semuaKelas' => $dataKelas
        ]);
    }

    // STORE (Proses Simpan)
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:siswas,nis|max:10', // FIX
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // SHOW (optional)
    public function show(Siswa $siswa)
    {
        //
    }

    // EDIT
    public function edit(Siswa $siswa)
    {
        $dataKelas = Kelas::all();

        return view('siswa.edit', [
            'siswa' => $siswa,
            'semuaKelas' => $dataKelas
        ]);
    }

    // UPDATE
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|string|max:10|unique:siswas,nis,' . $siswa->id, // FIX
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diubah.');
    }

    // DELETE
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
