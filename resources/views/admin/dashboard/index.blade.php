@extends('admin.layout.app-layout')

@section('title', 'Dashboard')

@push('css')
@endpush

@push('scripts')
    <!-- Chart.js CDN (bisa juga di-bundle lewat npm) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('growthChart').getContext('2d');

            fetch("{{ route('dashboard.data') }}")
                .then(res => res.json())
                .then(payload => {
                    const config = {
                        type: 'line',
                        data: {
                            labels: payload.labels,
                            datasets: payload.datasets.map(ds => ({
                                label: ds.label || 'Dataset',
                                data: ds.data,
                                fill: false,
                                tension: 0.2,
                            }))
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: false,
                                    title: {
                                        display: true,
                                        text: 'Berat (kg)'
                                    }
                                }
                            }
                        }
                    };
                    new Chart(ctx, config);
                })
                .catch(err => {
                    console.error('Gagal memuat data grafik', err);
                });
        });
    </script>
@endpush

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <div class="text-sm text-gray-600">Halo, {{ auth()->user()->name }}</div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white shadow rounded-xl p-6">
            <div class="text-gray-500 text-sm">Total Users</div>
            <div class="text-3xl font-bold mt-2">{{ $totalUsers }}</div>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <div class="text-gray-500 text-sm">Total Balita</div>
            <div class="text-3xl font-bold mt-2">{{ $totalChildren }}</div>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <div class="text-gray-500 text-sm">Jumlah Pengukuran</div>
            <div class="text-3xl font-bold mt-2">{{ $totalMeasurements }}</div>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="col-span-2 bg-white p-6 rounded-xl shadow">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Grafik Pertumbuhan (BB/U)</h2>
                <div class="text-sm text-gray-500">6 bulan terakhir</div>
            </div>

            <canvas id="growthChart" height="120"></canvas>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold mb-4">Aktivitas Terbaru</h2>
            <ul class="text-gray-700 list-disc ml-5 space-y-2">
                @forelse($recentMeasurements as $m)
                    <li>
                        <div class="text-sm">
                            {{ optional($m->child)->name ?? ('Anak ID ' . $m->child_id ?? '—') }}:
                            {{ $m->weight_kg ?? '—' }} kg — {{ $m->created_at->format('d M Y') }}
                        </div>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">Belum ada aktivitas terbaru.</li>
                @endforelse
            </ul>

            <hr class="my-4">
        </div>
    </div>

@endsection
