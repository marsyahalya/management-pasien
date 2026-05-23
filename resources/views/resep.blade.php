@extends('layouts.app')

@section('title', 'Resep Obat')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="font-semibold mb-3">Tambah Resep Obat</h3>
        <form action="/resep" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @csrf
            <select name="riwayat_kesehatan_id" class="border rounded px-3 py-2" required>
                <option value="">-- Pilih Riwayat --</option>
                @foreach ($riwayat as $r)
                    <option value="{{ $r->id }}">#{{ $r->id }} - {{ $r->pasien->nama ?? '-' }} ({{ $r->tanggal_kunjungan }})</option>
                @endforeach
            </select>
            <input type="date" name="tanggal_resep" class="border rounded px-3 py-2" required>
            <input type="text" name="catatan" placeholder="Catatan (opsional)" class="border rounded px-3 py-2">
            <button class="md:col-span-3 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Tambah</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold mb-3">Daftar Resep</h3>
        <table class="w-full text-sm border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Pasien</th>
                    <th class="p-2 border">Tgl Resep</th>
                    <th class="p-2 border">Catatan</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($resep as $rp)
                    <tr>
                        <td class="p-2 border text-center">{{ $rp->id }}</td>
                        <td class="p-2 border">{{ $rp->riwayat->pasien->nama ?? '-' }}</td>
                        <td class="p-2 border">{{ $rp->tanggal_resep }}</td>
                        <td class="p-2 border">{{ $rp->catatan }}</td>
                        <td class="p-2 border text-center">
                            <form action="/resep/{{ $rp->id }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center p-3">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
