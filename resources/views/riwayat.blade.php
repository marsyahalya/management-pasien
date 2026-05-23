@extends('layouts.app')

@section('title', 'Riwayat Kesehatan')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="font-semibold mb-3">Tambah Riwayat Kesehatan</h3>
        <form action="/riwayat" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @csrf
            <select name="pasien_id" class="border rounded px-3 py-2" required>
                <option value="">-- Pilih Pasien --</option>
                @foreach ($pasien as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
            <select name="dokter_id" class="border rounded px-3 py-2" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach ($dokter as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                @endforeach
            </select>
            <input type="date" name="tanggal_kunjungan" class="border rounded px-3 py-2" required>
            <input type="text" name="penyakit_diderita" placeholder="Penyakit" class="border rounded px-3 py-2" required>
            <input type="text" name="pengobatan" placeholder="Pengobatan" class="border rounded px-3 py-2" required>
            <input type="text" name="catatan" placeholder="Catatan (opsional)" class="border rounded px-3 py-2">
            <button class="md:col-span-3 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Tambah</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold mb-3">Daftar Riwayat</h3>
        <table class="w-full text-sm border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Pasien</th>
                    <th class="p-2 border">Dokter</th>
                    <th class="p-2 border">Tgl Kunjungan</th>
                    <th class="p-2 border">Penyakit</th>
                    <th class="p-2 border">Pengobatan</th>
                    <th class="p-2 border">Catatan</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $r)
                    <tr>
                        <td class="p-2 border text-center">{{ $r->id }}</td>
                        <td class="p-2 border">{{ $r->pasien->nama ?? '-' }}</td>
                        <td class="p-2 border">{{ $r->dokter->nama ?? '-' }}</td>
                        <td class="p-2 border">{{ $r->tanggal_kunjungan }}</td>
                        <td class="p-2 border">{{ $r->penyakit_diderita }}</td>
                        <td class="p-2 border">{{ $r->pengobatan }}</td>
                        <td class="p-2 border">{{ $r->catatan }}</td>
                        <td class="p-2 border text-center">
                            <form action="/riwayat/{{ $r->id }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center p-3">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
