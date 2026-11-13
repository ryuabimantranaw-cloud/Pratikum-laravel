<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DokterController extends Controller
{
    private $daftarSpesialisasi = ['Spesialis Penyakit Dalam', 'Spesialis Bedah Syaraf', 'Spesialis Anak', 'Spesialis Kulit'];
    private $daftarHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    public function index()
    {
        $data = Dokter::orderByDesc('id')->get();
        return view('dokter.index', compact('data'));
    }

    public function create()
    {
        return view('dokter.form', [
            'dokter'             => null,
            'daftarSpesialisasi' => $this->daftarSpesialisasi,
            'daftarHari'         => $this->daftarHari,
        ]);
    }

    public function store(Request $request)
    {
        Dokter::create($this->validasi($request));
        return redirect()->route('dokter.index')->with('pesan', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(Dokter $dokter)
    {
        return view('dokter.form', [
            'dokter'             => $dokter,
            'daftarSpesialisasi' => $this->daftarSpesialisasi,
            'daftarHari'         => $this->daftarHari,
        ]);
    }

    public function update(Request $request, Dokter $dokter)
    {
        $dokter->update($this->validasi($request, $dokter->id));
        return redirect()->route('dokter.index')->with('pesan', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokter.index')->with('pesan', 'Data dokter berhasil dihapus.');
    }

    public function reset()
    {
        Dokter::truncate();
        return redirect()->route('dokter.index')->with('pesan', 'Semua data dokter telah direset.');
    }

    private function validasi(Request $request, $id = null)
    {
        $data = $request->validate([
            'kode_dokter'   => ['required', 'max:20', Rule::unique('dokter_0004', 'kode_dokter')->ignore($id)],
            'nama_lengkap'  => 'required|max:100',
            'gelar'         => 'nullable|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'sip'           => 'required|max:50',
            'spesialisasi'  => ['required', Rule::in($this->daftarSpesialisasi)],
            'hari_praktik'  => 'nullable|array',
            'email'         => 'nullable|email|max:100',
            'telepon'       => 'required|max:20',
        ], [
            'kode_dokter.unique' => 'Kode dokter sudah dipakai, gunakan kode lain.',
        ]);

        $data['hari_praktik'] = implode(',', $request->input('hari_praktik', []));
        return $data;
    }
}