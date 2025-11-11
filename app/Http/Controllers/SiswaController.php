<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    // 📘 READ (Tampilkan Daftar Siswa)
    public function index()
    {
        // Ambil data siswa beserta relasi kelas (eager loading)
        $dataSiswa = Siswa::with('kelas')->get();

        return view('siswa.index', [
            'semuaSiswa' => $dataSiswa
        ]);
    }

    // 🟢 CREATE (Form Tambah Siswa)
    public function create()
    {
        // Ambil semua data kelas untuk dropdown pilihan kelas
        $dataKelas = Kelas::all();

        return view('siswa.create', [
            'semuaKelas' => $dataKelas
        ]);
    }

    // 🧾 STORE (Proses Simpan Siswa Baru)
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:siswa,nis|max:10',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id', // kelas_id harus valid
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);

        // Simpan data ke database
        Siswa::create($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // 📄 SHOW (Detail Siswa) - opsional
    public function show(Siswa $siswa)
    {
        // Kosongkan dulu kalau belum dipakai
    }

    // ✏️ EDIT (Tampilkan Form Ubah)
    public function edit(Siswa $siswa)
    {
        $dataKelas = Kelas::all();

        return view('siswa.edit', [
            'siswa' => $siswa,
            'semuaKelas' => $dataKelas
        ]);
    }

    // 🔄 UPDATE (Proses Ubah Data)
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => [
                'required',
                'string',
                'max:10',
                Rule::unique('siswa', 'nis')->ignore($siswa->id), // unik tapi abaikan data sendiri
            ],
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

    public function destroy(Siswa $siswa)
    {
        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
