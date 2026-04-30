<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="dashboard-eyebrow">Dashboard Pelapor</p>
                <h2 class="dashboard-title">Selamat datang, {{ auth()->user()->name }}</h2>
                <p class="dashboard-subtitle">Pantau status tiket, progres teknisi, dan jadwal maintenance dari sini.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="dashboard-badge">Total laporan: {{ $stats['total'] }}</span>
                <span class="dashboard-badge">Sedang diproses: {{ $stats['progress'] }}</span>
                <span class="dashboard-badge">Selesai: {{ $stats['done'] }}</span>
            </div>
        </div>
    </x-slot>

    <div class="dashboard-shell">
        <div class="dashboard-stack">
            <section class="dashboard-hero-soft animate-fade-in-up">
                <div class="dashboard-hero-content grid gap-8 xl:grid-cols-[1.15fr_0.85fr] xl:items-end">
                    <div>
                        <p class="dashboard-eyebrow">Ringkasan</p>
                        <h3 class="mt-3 max-w-3xl text-3xl font-semibold sm:text-4xl" style="letter-spacing: -0.03em; color: var(--text-primary);">Status laporan dan aktivitas terkini kamu hari ini.</h3>
                        <p class="mt-3 max-w-2xl text-sm leading-6" style="color: var(--text-secondary);">Cek tiket aktif, progres pekerjaan teknisi, dan buat laporan baru jika diperlukan.</p>
                        <div class="mt-6 flex flex-wrap gap-2">
                            <span class="dashboard-badge">Tiket aktif {{ $stats['pending'] + $stats['progress'] }}</span>
                            <span class="dashboard-badge">{{ $stats['done'] }} tiket selesai</span>
                            <span class="dashboard-badge">{{ $todayMaintenanceTasks->count() }} maintenance hari ini</span>
                        </div>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-1">
                        <div class="dashboard-floating-note">
                            <p class="dashboard-inline-label">Respons aktif</p>
                            <p class="mt-2 text-2xl font-semibold tracking-tight" style="color: var(--text-primary);">{{ $stats['progress'] }}</p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Laporan yang saat ini sedang ditangani teknisi.</p>
                        </div>
                        <div class="dashboard-floating-note">
                            <p class="dashboard-inline-label">Selesai hari ini</p>
                            <p class="mt-2 text-2xl font-semibold tracking-tight" style="color: var(--text-primary);">{{ $timeStats['today']['done_change'] }}</p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Jumlah tiketmu yang ditutup pada hari ini.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4 animate-fade-in-up animate-delay-1">
                @php $pelCards = [
                    ['label'=>'Pending','value'=>$stats['pending'],'meta'=>$timeStats['today']['pending_change'].' tambahan hari ini','icon'=>'<circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"/>'],
                    ['label'=>'Diproses','value'=>$stats['progress'],'meta'=>$timeStats['today']['progress_change'].' update progres hari ini','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M4 13h4l3-8 4 14 3-6h2"/>'],
                    ['label'=>'Selesai','value'=>$stats['done'],'meta'=>$timeStats['today']['done_change'].' selesai hari ini','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>'],
                    ['label'=>'Total tiket','value'=>$stats['total'],'meta'=>'Semua laporan yang pernah dibuat','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h5.5L19 11.5V19a2 2 0 0 1-2 2Z"/>'],
                ]; @endphp
                @foreach($pelCards as $sc)
                <article class="dashboard-stat-card">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="dashboard-stat-label">{{ $sc['label'] }}</p>
                            <p class="dashboard-stat-value">{{ $sc['value'] }}</p>
                            <p class="dashboard-stat-meta">{{ $sc['meta'] }}</p>
                        </div>
                        <div class="dashboard-icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">{!! $sc['icon'] !!}</svg>
                        </div>
                    </div>
                </article>
                @endforeach
            </section>

            <section class="grid grid-cols-1 gap-4 xl:grid-cols-[1.25fr_0.95fr] animate-fade-in-up animate-delay-2">
                <article class="dashboard-panel p-6">
                    <p class="dashboard-stat-label">Aksi utama</p>
                    <div class="mt-4 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <h3 class="text-2xl font-semibold tracking-tight" style="color: var(--text-primary);">Buat laporan baru atau lanjutkan memantau tiket yang berjalan</h3>
                            <p class="mt-2 max-w-2xl text-sm leading-6" style="color: var(--text-secondary);">Laporkan kerusakan atau cek update tiket yang sedang berjalan.</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('laporan.create') }}" class="inline-flex items-center rounded-2xl px-4 py-3 text-sm font-medium transition" style="background: linear-gradient(135deg, var(--accent), var(--accent-soft)); color: #050508;">
                                Buat laporan
                            </a>
                            <a href="{{ route('laporan.index') }}" class="inline-flex items-center rounded-2xl px-4 py-3 text-sm font-medium transition" style="border: 1px solid var(--border); background: var(--bg-card); color: var(--text-primary);">
                                Lihat semua tiket
                            </a>
                        </div>
                    </div>
                </article>

                <article class="dashboard-tonal-card">
                    <p class="dashboard-stat-label">Status cepat</p>
                    <div class="mt-4 space-y-3">
                        <div class="rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                            <p class="text-sm font-medium" style="color: var(--text-primary);">Tiket aktif</p>
                            <p class="mt-2 text-3xl font-semibold" style="color: var(--text-primary);">{{ $stats['pending'] + $stats['progress'] }}</p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Gabungan pending dan progress.</p>
                        </div>
                        <div class="rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                            <p class="text-sm font-medium" style="color: var(--text-primary);">Maintenance hari ini</p>
                            <p class="mt-2 text-3xl font-semibold" style="color: var(--text-primary);">{{ $todayMaintenanceTasks->count() }}</p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Jadwal umum yang sedang berjalan.</p>
                        </div>
                    </div>
                </article>
            </section>

            <section class="grid grid-cols-1 gap-4 md:grid-cols-3 animate-fade-in-up animate-delay-3">
                <a href="{{ route('laporan.create') }}" class="dashboard-link-card">
                    <div><p class="dashboard-link-title">Laporan baru</p><p class="dashboard-link-copy">Buat tiket baru dengan cepat saat ada kerusakan atau kendala.</p></div>
                    <svg class="h-5 w-5" style="color: var(--text-tertiary);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
                <a href="{{ route('maintenance.tasks.index') }}" class="dashboard-link-card">
                    <div><p class="dashboard-link-title">Maintenance</p><p class="dashboard-link-copy">Lihat pekerjaan maintenance yang sedang berlangsung hari ini.</p></div>
                    <svg class="h-5 w-5" style="color: var(--text-tertiary);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
                <a href="{{ route('laporan.index') }}" class="dashboard-link-card">
                    <div><p class="dashboard-link-title">Arsip laporan</p><p class="dashboard-link-copy">Masuk ke daftar lengkap untuk cari atau filter tiket lama.</p></div>
                    <svg class="h-5 w-5" style="color: var(--text-tertiary);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
            </section>

            @if(isset($chartData) && count($chartData['labels']) > 0)
                <section class="dashboard-panel p-5 animate-fade-in-up animate-delay-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="dashboard-section-title">Aktivitas 7 hari terakhir</h3>
                            <p class="dashboard-section-copy">Perbandingan laporan yang dibuat dan yang selesai.</p>
                        </div>
                        <span class="dashboard-badge">Trend</span>
                    </div>
                    <div class="mt-5"><canvas id="pelaporChart" height="110"></canvas></div>
                </section>
            @endif

            @if(isset($todayMaintenanceTasks) && $todayMaintenanceTasks->count() > 0)
                <section class="dashboard-panel overflow-hidden animate-fade-in-up animate-delay-5">
                    <div class="dashboard-section-head">
                        <div>
                            <h3 class="dashboard-section-title">Maintenance hari ini</h3>
                            <p class="dashboard-section-copy">Ringkasan jadwal maintenance yang sedang berjalan.</p>
                        </div>
                    </div>
                    <div class="space-y-3 px-5 py-4">
                        @foreach($todayMaintenanceTasks->take(3) as $task)
                            <div class="rounded-2xl px-4 py-4" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="text-sm font-semibold" style="color: var(--text-primary);">{{ $task->schedule->nama_tugas }}</p>
                                    <span class="rounded-full px-3 py-1 text-xs font-medium" style="background: var(--accent-glow); color: var(--accent); border: 1px solid var(--accent-border);">{{ ucfirst($task->status) }}</span>
                                </div>
                                <p class="mt-2 text-sm" style="color: var(--text-secondary);">{{ $task->schedule->lokasi }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="dashboard-panel overflow-hidden animate-fade-in-up animate-delay-6">
                <div class="dashboard-section-head">
                    <div>
                        <h3 class="dashboard-section-title">Laporan saya</h3>
                        <p class="dashboard-section-copy">Daftar tiket terbaru yang kamu buat.</p>
                    </div>
                    <a href="{{ route('laporan.index') }}" class="text-sm font-medium" style="color: var(--accent);">Lihat semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="dashboard-table">
                        <thead><tr><th>No. Tiket</th><th>Department</th><th>Lokasi</th><th>Status</th><th>Teknisi</th><th>Aksi</th></tr></thead>
                        <tbody>
                            @forelse($myLaporans as $laporan)
                                <tr>
                                    <td class="font-medium" style="color: var(--text-primary);">{{ $laporan->ticket_number }}</td>
                                    <td>{{ $laporan->department->name }}</td>
                                    <td>{{ $laporan->location }}</td>
                                    <td>@include('components.status-badge', ['status' => $laporan->status])</td>
                                    <td>{{ $laporan->assignment?->teknisi?->name ?? '-' }}</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('laporan.show', $laporan) }}" class="font-medium" style="color: var(--accent);">Detail</a>
                                            @if($laporan->status === 'pending')
                                                <a href="{{ route('laporan.edit', $laporan) }}" class="font-medium" style="color: var(--text-secondary);">Edit</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="dashboard-empty">Belum ada laporan yang dibuat.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    @if(isset($chartData) && count($chartData['labels']) > 0)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            (function() {
                const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                const accentColor = '#2EC4B6';
                const gridColor = isDark ? 'rgba(255,255,255,0.04)' : 'rgba(0,0,0,0.05)';
                const tickColor = isDark ? 'rgba(238,241,240,0.3)' : '#64748b';
                const legendColor = isDark ? 'rgba(238,241,240,0.4)' : '#475569';
                const secondaryLine = isDark ? 'rgba(238,241,240,0.25)' : '#94a3b8';
                const secondaryFill = isDark ? 'rgba(255,255,255,0.03)' : 'rgba(0,0,0,0.02)';

                new Chart(document.getElementById('pelaporChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartData['labels']) !!},
                        datasets: [
                            { 
                                label:'Dibuat', 
                                data:{!! json_encode($chartData['created']) !!}, 
                                borderColor: accentColor, 
                                backgroundColor: isDark ? 'rgba(46,196,182,0.12)' : 'rgba(46,196,182,0.1)', 
                                pointBackgroundColor: accentColor, 
                                borderWidth: 2, 
                                pointRadius: 3, 
                                tension: 0.35, 
                                fill: true 
                            },
                            { 
                                label:'Selesai', 
                                data:{!! json_encode($chartData['completed']) !!}, 
                                borderColor: secondaryLine, 
                                backgroundColor: secondaryFill, 
                                pointBackgroundColor: secondaryLine, 
                                borderWidth: 2, 
                                pointRadius: 3, 
                                tension: 0.35, 
                                fill: true 
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: { 
                            legend: { 
                                position: 'bottom', 
                                labels: { 
                                    color: legendColor, 
                                    font: { family: 'Inter, sans-serif' } 
                                } 
                            } 
                        },
                        scales: {
                            x: { 
                                grid: { display: false }, 
                                ticks: { color: tickColor, font: { family: 'Inter, sans-serif', size: 11 } } 
                            },
                            y: { 
                                beginAtZero: true, 
                                grid: { color: gridColor, drawBorder: false }, 
                                ticks: { stepSize: 1, color: tickColor, font: { family: 'Inter, sans-serif', size: 11 } } 
                            }
                        }
                    }
                });
            })();
        </script>
    @endif
</x-app-layout>
