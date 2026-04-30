<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div>
                <p class="dashboard-eyebrow">Dashboard Admin</p>
                <h2 class="dashboard-title">Ringkasan operasional hotel</h2>
                <p class="dashboard-subtitle">Pantau volume laporan dan progres penyelesaian dari satu tampilan.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="dashboard-badge">Total laporan: {{ $stats['total'] }}</span>
                <span class="dashboard-badge">Overdue: {{ $stats['overdue'] }}</span>

            </div>
        </div>
    </x-slot>

    @php
        $completionRate = $stats['total'] > 0 ? round(($stats['done'] / $stats['total']) * 100) : 0;
        $dailyTrend = $timeStats['today']['created'] - $timeStats['yesterday']['created'];
    @endphp

    <div class="dashboard-shell">
        <div class="dashboard-stack">
            <section class="dashboard-hero animate-fade-in-up">
                <div class="dashboard-hero-content grid gap-8 xl:grid-cols-[1.2fr_0.8fr] xl:items-end">
                    <div>
                        <p class="dashboard-hero-kicker">Control Center</p>
                        <h3 class="dashboard-hero-title">Pantau seluruh operasional hotel dalam satu halaman.</h3>
                        <p class="dashboard-hero-copy">Volume tiket masuk dan kecepatan penyelesaian — semua terangkum di sini.</p>
                        <div class="mt-6 flex flex-wrap gap-2">
                            <span class="dashboard-chip-dark">Completion rate {{ $completionRate }}%</span>
                            <span class="dashboard-chip-dark">{{ $stats['progress'] }} tiket masih berjalan</span>

                        </div>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-1">
                        <div class="dashboard-floating-note">
                            <p class="dashboard-inline-label">Tren harian</p>
                            <p class="mt-2 text-2xl font-semibold tracking-tight" style="color: var(--text-primary);">{{ $dailyTrend > 0 ? '+' : '' }}{{ $dailyTrend }}</p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Perbandingan tiket dibuat vs kemarin.</p>
                        </div>
                        <div class="dashboard-floating-note">
                            <p class="dashboard-inline-label">Overdue</p>
                            <p class="mt-2 text-2xl font-semibold tracking-tight" style="color: var(--text-primary);">{{ $stats['overdue'] }}</p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Tiket yang butuh follow up segera.</p>
                        </div>
                    </div>
                </div>
                <div class="dashboard-hero-metrics">
                    <div class="dashboard-hero-metric">
                        <p class="dashboard-hero-metric-label">Hari ini</p>
                        <p class="dashboard-hero-metric-value">{{ $timeStats['today']['created'] }}</p>
                        <p class="dashboard-hero-metric-copy">{{ $timeStats['today']['completed'] }} selesai di hari yang sama.</p>
                    </div>
                    <div class="dashboard-hero-metric">
                        <p class="dashboard-hero-metric-label">Minggu ini</p>
                        <p class="dashboard-hero-metric-value">{{ $timeStats['this_week']['created'] }}</p>
                        <p class="dashboard-hero-metric-copy">{{ $timeStats['this_week']['completed'] }} laporan berhasil ditutup.</p>
                    </div>
                    <div class="dashboard-hero-metric">
                        <p class="dashboard-hero-metric-label">Bulan ini</p>
                        <p class="dashboard-hero-metric-value">{{ $timeStats['this_month']['created'] }}</p>
                        <p class="dashboard-hero-metric-copy">Tingkat penyelesaian {{ $completionRate }}%.</p>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
                @php $statCards = [
                    ['label'=>'Pending','value'=>$stats['pending'],'meta'=>$timeStats['today']['pending_change'].' laporan baru hari ini','icon'=>'<circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"/>'],
                    ['label'=>'Progress','value'=>$stats['progress'],'meta'=>$timeStats['today']['progress_change'].' pembaruan status hari ini','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M4 13h4l3-8 4 14 3-6h2"/>'],
                    ['label'=>'Selesai','value'=>$stats['done'],'meta'=>$timeStats['today']['done_change'].' selesai hari ini','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>'],
                    ['label'=>'Overdue','value'=>$stats['overdue'],'meta'=>'Butuh follow up prioritas tinggi','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/><path stroke-linecap="round" stroke-linejoin="round" d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>'],
                    ['label'=>'Completion Rate','value'=>$completionRate.'%','meta'=>$stats['done'].' dari '.$stats['total'].' laporan selesai','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18"/>'],
                ]; @endphp
                @foreach($statCards as $i => $sc)
                <article class="dashboard-stat-card animate-fade-in-up animate-delay-{{ $i+1 }}">
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

            <section class="grid grid-cols-1 gap-4 lg:grid-cols-[1.4fr_0.9fr] animate-fade-in-up animate-delay-3">
                <article class="dashboard-tonal-card">
                    <p class="dashboard-stat-label">Aktivitas Terkini</p>
                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
                        @foreach(['today'=>'Hari ini','this_week'=>'Minggu ini','this_month'=>'Bulan ini'] as $key=>$lbl)
                        <div>
                            <p class="text-sm font-medium" style="color: var(--text-tertiary);">{{ $lbl }}</p>
                            <p class="mt-2 text-3xl font-semibold" style="color: var(--text-primary);">{{ $timeStats[$key]['created'] }}</p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">{{ $timeStats[$key]['completed'] }} selesai</p>
                        </div>
                        @endforeach
                    </div>
                </article>

                <article class="dashboard-panel p-5">
                    <p class="dashboard-stat-label">Catatan Hari Ini</p>
                    <div class="mt-4 space-y-3">
                        <div class="rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                            <p class="text-sm font-medium" style="color: var(--text-primary);">Tren laporan</p>
                            <p class="mt-1 text-sm" style="color: var(--text-secondary);">{{ $dailyTrend > 0 ? '+' : '' }}{{ $dailyTrend }} dibanding kemarin.</p>
                        </div>
                        <div class="rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                            <p class="text-sm font-medium" style="color: var(--text-primary);">Overdue</p>
                            <p class="mt-1 text-sm" style="color: var(--text-secondary);">{{ $stats['overdue'] }} tiket butuh perhatian segera.</p>
                        </div>
                    </div>
                </article>
            </section>

            <section class="grid grid-cols-1 gap-4 md:grid-cols-2 animate-fade-in-up animate-delay-4">
                <a href="{{ route('laporan.index') }}" class="dashboard-link-card">
                    <div>
                        <p class="dashboard-link-title">Kelola laporan</p>
                        <p class="dashboard-link-copy">Lihat seluruh tiket, filter status, dan pantau SLA.</p>
                    </div>
                    <svg class="h-5 w-5" style="color: var(--text-tertiary);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
                <a href="{{ route('laporan.create') }}" class="dashboard-link-card">
                    <div>
                        <p class="dashboard-link-title">Buat laporan baru</p>
                        <p class="dashboard-link-copy">Laporkan kerusakan atau kendala operasional.</p>
                    </div>
                    <svg class="h-5 w-5" style="color: var(--text-tertiary);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
            </section>

            <section class="grid grid-cols-1 gap-6 xl:grid-cols-[1.4fr_1fr] animate-fade-in-up animate-delay-5">
                <div class="space-y-6">
                    <article class="dashboard-panel p-5">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="dashboard-section-title">Laporan 7 hari terakhir</h3>
                                <p class="dashboard-section-copy">Perbandingan tiket masuk dan tiket selesai.</p>
                            </div>
                            <span class="dashboard-badge">Harian</span>
                        </div>
                        <div class="mt-5"><canvas id="dailyChart" height="110"></canvas></div>
                    </article>

                    <article class="dashboard-panel p-5">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="dashboard-section-title">Laporan 6 bulan terakhir</h3>
                                <p class="dashboard-section-copy">Melihat kapasitas penanganan secara bulanan.</p>
                            </div>
                            <span class="dashboard-badge">Bulanan</span>
                        </div>
                        <div class="mt-5"><canvas id="monthlyChart" height="110"></canvas></div>
                    </article>
                </div>

                <div class="space-y-6">
                    <article class="dashboard-panel p-5">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="dashboard-section-title">Distribusi prioritas</h3>
                                <p class="dashboard-section-copy">Komposisi tiket berdasarkan tingkat urgensi.</p>
                            </div>
                        </div>
                        <div class="mt-5"><canvas id="priorityChart" height="240"></canvas></div>
                    </article>

                    <article class="dashboard-panel overflow-hidden">
                        <div class="dashboard-section-head">
                            <div>
                                <h3 class="dashboard-section-title">Teknisi teratas</h3>
                                <p class="dashboard-section-copy">Berdasarkan assignment yang selesai.</p>
                            </div>
                        </div>
                        <div class="space-y-3 px-5 py-4">
                            @forelse($topTeknisi as $teknisi)
                                <div class="flex items-center justify-between rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025); transition: all 200ms;">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-semibold" style="background: linear-gradient(135deg, var(--accent), var(--accent-soft)); color: #050508;">
                                            {{ strtoupper(substr($teknisi->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold" style="color: var(--text-primary);">{{ $teknisi->name }}</p>
                                            <p class="text-xs" style="color: var(--text-tertiary);">{{ $teknisi->email }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-semibold" style="color: var(--accent);">{{ $teknisi->completed_count }} selesai</span>
                                </div>
                            @empty
                                <div class="dashboard-empty py-8">Belum ada data teknisi.</div>
                            @endforelse
                        </div>
                    </article>
                </div>
            </section>


                <article class="dashboard-panel overflow-hidden">
                    <div class="dashboard-section-head">
                        <div>
                            <h3 class="dashboard-section-title">Top department</h3>
                            <p class="dashboard-section-copy">Sumber laporan terbanyak.</p>
                        </div>
                    </div>
                    <div class="space-y-3 px-5 py-4">
                        @forelse($departmentStats as $department)
                            <div class="flex items-center justify-between rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                                <div>
                                    <p class="text-sm font-semibold" style="color: var(--text-primary);">{{ $department->department?->name ?? 'Tanpa Department' }}</p>
                                    <p class="text-xs" style="color: var(--text-tertiary);">Total tiket aktif dan historis</p>
                                </div>
                                <span class="text-sm font-semibold" style="color: var(--accent);">{{ $department->count }}</span>
                            </div>
                        @empty
                            <div class="dashboard-empty py-8">Belum ada data department.</div>
                        @endforelse
                    </div>
                </article>
            </section>

            <section class="dashboard-panel overflow-hidden animate-fade-in-up animate-delay-7">
                <div class="dashboard-section-head">
                    <div>
                        <h3 class="dashboard-section-title">Laporan terbaru</h3>
                        <p class="dashboard-section-copy">Daftar tiket terbaru untuk monitoring cepat.</p>
                    </div>
                    <a href="{{ route('laporan.index') }}" class="text-sm font-medium transition" style="color: var(--accent);">Lihat semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>No. Tiket</th><th>Pelapor</th><th>Department</th><th>Prioritas</th><th>Status</th><th>Teknisi</th><th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentLaporans as $laporan)
                                <tr>
                                    <td class="font-medium" style="color: var(--text-primary);">{{ $laporan->ticket_number }}</td>
                                    <td>{{ $laporan->pelapor->name }}</td>
                                    <td>{{ $laporan->department->name }}</td>
                                    <td class="capitalize">{{ $laporan->priority }}</td>
                                    <td>@include('components.status-badge', ['status' => $laporan->is_overdue ? 'overdue' : $laporan->status])</td>
                                    <td>{{ $laporan->assignment?->teknisi?->name ?? '-' }}</td>
                                    <td><a href="{{ route('laporan.show', $laporan) }}" class="font-medium" style="color: var(--accent);">Detail</a></td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="dashboard-empty">Belum ada laporan terbaru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function() {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            const chartFont = { family: 'Inter, sans-serif' };
            const gridColor = isDark ? 'rgba(255,255,255,0.04)' : 'rgba(0,0,0,0.05)';
            const chartGrid = { color: gridColor, drawBorder: false };
            const tickColor = isDark ? 'rgba(238,241,240,0.3)' : '#64748b';
            const chartTicks = { color: tickColor, font: { family: 'Inter, sans-serif', size: 11 } };
            const legendColor = isDark ? 'rgba(238,241,240,0.4)' : '#475569';
            
            const teal = '#2EC4B6';
            const tealSoft = isDark ? 'rgba(46,196,182,0.15)' : 'rgba(46,196,182,0.1)';
            const dimLine = isDark ? 'rgba(238,241,240,0.25)' : '#94a3b8';
            const dimFill = isDark ? 'rgba(255,255,255,0.03)' : 'rgba(0,0,0,0.02)';

            new Chart(document.getElementById('dailyChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData['labels']) !!},
                    datasets: [
                        { label:'Dibuat', data:{!! json_encode($chartData['created']) !!}, borderColor:teal, backgroundColor:tealSoft, pointRadius:3, pointBackgroundColor:teal, borderWidth:2, tension:0.35, fill:true },
                        { label:'Selesai', data:{!! json_encode($chartData['completed']) !!}, borderColor:dimLine, backgroundColor:dimFill, pointRadius:3, pointBackgroundColor:dimLine, borderWidth:2, tension:0.35, fill:true }
                    ]
                },
                options: { 
                    responsive:true, 
                    plugins:{ 
                        legend:{ 
                            position:'bottom', 
                            labels:{ boxWidth:10, boxHeight:10, usePointStyle:true, pointStyle:'circle', font:chartFont, color:legendColor } 
                        } 
                    }, 
                    scales:{ x:{ grid:{display:false}, ticks:chartTicks }, y:{ beginAtZero:true, grid:chartGrid, ticks:{...chartTicks, stepSize:1} } } 
                }
            });

            new Chart(document.getElementById('monthlyChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($monthlyData['labels']) !!},
                    datasets: [
                        { label:'Dibuat', data:{!! json_encode($monthlyData['created']) !!}, backgroundColor:teal, borderRadius:8 },
                        { label:'Selesai', data:{!! json_encode($monthlyData['completed']) !!}, backgroundColor:isDark ? 'rgba(46,196,182,0.25)' : 'rgba(46,196,182,0.15)', borderRadius:8 }
                    ]
                },
                options: { 
                    responsive:true, 
                    plugins:{ 
                        legend:{ 
                            position:'bottom', 
                            labels:{ boxWidth:10, boxHeight:10, font:chartFont, color:legendColor } 
                        } 
                    }, 
                    scales:{ x:{ grid:{display:false}, ticks:chartTicks }, y:{ beginAtZero:true, grid:chartGrid, ticks:{...chartTicks, stepSize:1} } } 
                }
            });

            new Chart(document.getElementById('priorityChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Low','Medium','High','Urgent'],
                    datasets: [{ 
                        data:{!! json_encode(array_values($priorityStats)) !!}, 
                        backgroundColor: isDark 
                            ? ['rgba(46,196,182,0.2)','rgba(46,196,182,0.4)','rgba(46,196,182,0.65)',teal]
                            : ['rgba(46,196,182,0.15)','rgba(46,196,182,0.3)','rgba(46,196,182,0.5)',teal], 
                        borderWidth:0 
                    }]
                },
                options: { 
                    responsive:true, 
                    cutout:'65%', 
                    plugins:{ 
                        legend:{ 
                            position:'bottom', 
                            labels:{ boxWidth:10, boxHeight:10, font:chartFont, color:legendColor } 
                        } 
                    } 
                }
            });
        })();
    </script>
</x-app-layout>
