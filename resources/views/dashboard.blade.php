@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $cards = [
            ['label' => 'Total Pasien',          'value' => $stats['pasien'],  'color' => 'bg-blue-500',    'route' => 'pasien'],
            ['label' => 'Total Dokter',          'value' => $stats['dokter'],  'color' => 'bg-green-500',   'route' => 'dokter'],
            ['label' => 'Total Obat',            'value' => $stats['obat'],    'color' => 'bg-yellow-500',  'route' => 'obat'],
            ['label' => 'Riwayat Kesehatan',     'value' => $stats['riwayat'], 'color' => 'bg-purple-500',  'route' => 'riwayat'],
            ['label' => 'Resep Obat',            'value' => $stats['resep'],   'color' => 'bg-pink-500',    'route' => 'resep'],
            ['label' => 'Item Resep',            'value' => $stats['items'],   'color' => 'bg-indigo-500',  'route' => 'resep_item'],
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @foreach ($cards as $c)
            <a href="{{ route($c['route']) }}" class="block bg-white rounded-lg shadow p-5 hover:shadow-lg transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">{{ $c['label'] }}</p>
                        <p class="text-3xl font-bold mt-1">{{ $c['value'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full {{ $c['color'] }} flex items-center justify-center text-white font-bold">
                        {{ substr($c['label'], 0, 1) }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-2">Selamat datang!</h3>
        <p class="text-sm text-gray-600">
            Gunakan menu di sebelah kiri untuk mengelola data pasien, dokter, obat, riwayat kesehatan,
            resep obat, dan item resep obat.
        </p>
    </div>
@endsection
