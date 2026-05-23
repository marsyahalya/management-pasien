<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\ResepObat;
use App\Models\ResepObatItem;
use App\Models\RiwayatKesehatan;
use Illuminate\Http\Request;

class KesehatanController extends Controller
{
    // ===== DASHBOARD =====
    public function dashboard()
    {
        $stats = [
            'pasien'  => Pasien::count(),
            'dokter'  => Dokter::count(),
            'obat'    => Obat::count(),
            'riwayat' => RiwayatKesehatan::count(),
            'resep'   => ResepObat::count(),
            'items'   => ResepObatItem::count(),
        ];
        return view('dashboard', compact('stats'));
    }

    // ===== PASIEN =====
    public function pasien()
    {
        $pasien = Pasien::orderBy('id', 'desc')->get();
        return view('pasien', compact('pasien'));
    }

    public function storePasien(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string|max:200',
            'nomor_telepon' => 'required|string|max:20',
        ]);
        Pasien::create($data);
        return back()->with('ok', 'Pasien ditambahkan');
    }

    public function destroyPasien($id)
    {
        Pasien::findOrFail($id)->delete();
        return back()->with('ok', 'Pasien dihapus');
    }

    // ===== DOKTER =====
    public function dokter()
    {
        $dokter = Dokter::orderBy('id', 'desc')->get();
        return view('dokter', compact('dokter'));
    }

    public function storeDokter(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:100',
            'spesialis'     => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:20',
        ]);
        Dokter::create($data);
        return back()->with('ok', 'Dokter ditambahkan');
    }

    public function destroyDokter($id)
    {
        Dokter::findOrFail($id)->delete();
        return back()->with('ok', 'Dokter dihapus');
    }

    // ===== OBAT =====
    public function obat()
    {
        $obat = Obat::orderBy('id', 'desc')->get();
        return view('obat', compact('obat'));
    }

    public function storeObat(Request $request)
    {
        $data = $request->validate([
            'nama_obat' => 'required|string|max:100',
            'dosis'     => 'required|string|max:50',
        ]);
        Obat::create($data);
        return back()->with('ok', 'Obat ditambahkan');
    }

    public function destroyObat($id)
    {
        Obat::findOrFail($id)->delete();
        return back()->with('ok', 'Obat dihapus');
    }

    // ===== RIWAYAT KESEHATAN =====
    public function riwayat()
    {
        $riwayat = RiwayatKesehatan::with(['pasien', 'dokter'])->orderBy('id', 'desc')->get();
        $pasien  = Pasien::orderBy('nama')->get();
        $dokter  = Dokter::orderBy('nama')->get();
        return view('riwayat', compact('riwayat', 'pasien', 'dokter'));
    }

    public function storeRiwayat(Request $request)
    {
        $data = $request->validate([
            'pasien_id'         => 'required|exists:pasien,id',
            'dokter_id'         => 'required|exists:dokter,id',
            'tanggal_kunjungan' => 'required|date',
            'penyakit_diderita' => 'required|string|max:150',
            'pengobatan'        => 'required|string|max:150',
            'catatan'           => 'nullable|string',
        ]);
        RiwayatKesehatan::create($data);
        return back()->with('ok', 'Riwayat ditambahkan');
    }

    public function destroyRiwayat($id)
    {
        RiwayatKesehatan::findOrFail($id)->delete();
        return back()->with('ok', 'Riwayat dihapus');
    }

    // ===== RESEP OBAT =====
    public function resep()
    {
        $resep   = ResepObat::with('riwayat.pasien')->orderBy('id', 'desc')->get();
        $riwayat = RiwayatKesehatan::with('pasien')->orderBy('id', 'desc')->get();
        return view('resep', compact('resep', 'riwayat'));
    }

    public function storeResep(Request $request)
    {
        $data = $request->validate([
            'riwayat_kesehatan_id' => 'required|exists:riwayat_kesehatan,id',
            'tanggal_resep'        => 'required|date',
            'catatan'              => 'nullable|string',
        ]);
        ResepObat::create($data);
        return back()->with('ok', 'Resep ditambahkan');
    }

    public function destroyResep($id)
    {
        ResepObat::findOrFail($id)->delete();
        return back()->with('ok', 'Resep dihapus');
    }

    // ===== ITEM RESEP =====
    public function resepItem()
    {
        $items = ResepObatItem::with(['resep', 'obat'])->orderBy('id', 'desc')->get();
        $resep = ResepObat::orderBy('id', 'desc')->get();
        $obat  = Obat::orderBy('nama_obat')->get();
        return view('resep_item', compact('items', 'resep', 'obat'));
    }

    public function storeResepItem(Request $request)
    {
        $data = $request->validate([
            'resep_obat_id' => 'required|exists:resep_obat,id',
            'obat_id'       => 'required|exists:obat,id',
            'jumlah'        => 'required|integer|min:1',
        ]);
        ResepObatItem::create($data);
        return back()->with('ok', 'Item resep ditambahkan');
    }

    public function destroyResepItem($id)
    {
        ResepObatItem::findOrFail($id)->delete();
        return back()->with('ok', 'Item resep dihapus');
    }
}
