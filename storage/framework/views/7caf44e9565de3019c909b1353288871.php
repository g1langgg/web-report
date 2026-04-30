<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="dashboard-header">
            <div>
                <p class="dashboard-eyebrow">Dashboard Admin</p>
                <h2 class="dashboard-title">Ringkasan operasional hotel</h2>
                <p class="dashboard-subtitle">Pantau volume laporan dan progres penyelesaian dari satu tampilan.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="dashboard-badge">Total laporan: <?php echo e($stats['total']); ?></span>
                <span class="dashboard-badge">Overdue: <?php echo e($stats['overdue']); ?></span>

            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <?php
        $completionRate = $stats['total'] > 0 ? round(($stats['done'] / $stats['total']) * 100) : 0;
        $dailyTrend = $timeStats['today']['created'] - $timeStats['yesterday']['created'];
    ?>

    <div class="dashboard-shell">
        <div class="dashboard-stack">
            <section class="dashboard-hero animate-fade-in-up">
                <div class="dashboard-hero-content grid gap-8 xl:grid-cols-[1.2fr_0.8fr] xl:items-end">
                    <div>
                        <p class="dashboard-hero-kicker">Control Center</p>
                        <h3 class="dashboard-hero-title">Pantau seluruh operasional hotel dalam satu halaman.</h3>
                        <p class="dashboard-hero-copy">Volume tiket masuk dan kecepatan penyelesaian — semua terangkum di sini.</p>
                        <div class="mt-6 flex flex-wrap gap-2">
                            <span class="dashboard-chip-dark">Completion rate <?php echo e($completionRate); ?>%</span>
                            <span class="dashboard-chip-dark"><?php echo e($stats['progress']); ?> tiket masih berjalan</span>

                        </div>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-1">
                        <div class="dashboard-floating-note">
                            <p class="dashboard-inline-label">Tren harian</p>
                            <p class="mt-2 text-2xl font-semibold tracking-tight" style="color: var(--text-primary);"><?php echo e($dailyTrend > 0 ? '+' : ''); ?><?php echo e($dailyTrend); ?></p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Perbandingan tiket dibuat vs kemarin.</p>
                        </div>
                        <div class="dashboard-floating-note">
                            <p class="dashboard-inline-label">Overdue</p>
                            <p class="mt-2 text-2xl font-semibold tracking-tight" style="color: var(--text-primary);"><?php echo e($stats['overdue']); ?></p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Tiket yang butuh follow up segera.</p>
                        </div>
                    </div>
                </div>
                <div class="dashboard-hero-metrics">
                    <div class="dashboard-hero-metric">
                        <p class="dashboard-hero-metric-label">Hari ini</p>
                        <p class="dashboard-hero-metric-value"><?php echo e($timeStats['today']['created']); ?></p>
                        <p class="dashboard-hero-metric-copy"><?php echo e($timeStats['today']['completed']); ?> selesai di hari yang sama.</p>
                    </div>
                    <div class="dashboard-hero-metric">
                        <p class="dashboard-hero-metric-label">Minggu ini</p>
                        <p class="dashboard-hero-metric-value"><?php echo e($timeStats['this_week']['created']); ?></p>
                        <p class="dashboard-hero-metric-copy"><?php echo e($timeStats['this_week']['completed']); ?> laporan berhasil ditutup.</p>
                    </div>
                    <div class="dashboard-hero-metric">
                        <p class="dashboard-hero-metric-label">Bulan ini</p>
                        <p class="dashboard-hero-metric-value"><?php echo e($timeStats['this_month']['created']); ?></p>
                        <p class="dashboard-hero-metric-copy">Tingkat penyelesaian <?php echo e($completionRate); ?>%.</p>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
                <?php $statCards = [
                    ['label'=>'Pending','value'=>$stats['pending'],'meta'=>$timeStats['today']['pending_change'].' laporan baru hari ini','icon'=>'<circle cx="12" cy="12" r="9"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"/>'],
                    ['label'=>'Progress','value'=>$stats['progress'],'meta'=>$timeStats['today']['progress_change'].' pembaruan status hari ini','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M4 13h4l3-8 4 14 3-6h2"/>'],
                    ['label'=>'Selesai','value'=>$stats['done'],'meta'=>$timeStats['today']['done_change'].' selesai hari ini','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>'],
                    ['label'=>'Overdue','value'=>$stats['overdue'],'meta'=>'Butuh follow up prioritas tinggi','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/><path stroke-linecap="round" stroke-linejoin="round" d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>'],
                    ['label'=>'Completion Rate','value'=>$completionRate.'%','meta'=>$stats['done'].' dari '.$stats['total'].' laporan selesai','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18"/>'],
                ]; ?>
                <?php $__currentLoopData = $statCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="dashboard-stat-card animate-fade-in-up animate-delay-<?php echo e($i+1); ?>">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="dashboard-stat-label"><?php echo e($sc['label']); ?></p>
                            <p class="dashboard-stat-value"><?php echo e($sc['value']); ?></p>
                            <p class="dashboard-stat-meta"><?php echo e($sc['meta']); ?></p>
                        </div>
                        <div class="dashboard-icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><?php echo $sc['icon']; ?></svg>
                        </div>
                    </div>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </section>

            <section class="grid grid-cols-1 gap-4 lg:grid-cols-[1.4fr_0.9fr] animate-fade-in-up animate-delay-3">
                <article class="dashboard-tonal-card">
                    <p class="dashboard-stat-label">Aktivitas Terkini</p>
                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
                        <?php $__currentLoopData = ['today'=>'Hari ini','this_week'=>'Minggu ini','this_month'=>'Bulan ini']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <p class="text-sm font-medium" style="color: var(--text-tertiary);"><?php echo e($lbl); ?></p>
                            <p class="mt-2 text-3xl font-semibold" style="color: var(--text-primary);"><?php echo e($timeStats[$key]['created']); ?></p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);"><?php echo e($timeStats[$key]['completed']); ?> selesai</p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </article>

                <article class="dashboard-panel p-5">
                    <p class="dashboard-stat-label">Catatan Hari Ini</p>
                    <div class="mt-4 space-y-3">
                        <div class="rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                            <p class="text-sm font-medium" style="color: var(--text-primary);">Tren laporan</p>
                            <p class="mt-1 text-sm" style="color: var(--text-secondary);"><?php echo e($dailyTrend > 0 ? '+' : ''); ?><?php echo e($dailyTrend); ?> dibanding kemarin.</p>
                        </div>
                        <div class="rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                            <p class="text-sm font-medium" style="color: var(--text-primary);">Overdue</p>
                            <p class="mt-1 text-sm" style="color: var(--text-secondary);"><?php echo e($stats['overdue']); ?> tiket butuh perhatian segera.</p>
                        </div>
                    </div>
                </article>
            </section>

            <section class="grid grid-cols-1 gap-4 md:grid-cols-2 animate-fade-in-up animate-delay-4">
                <a href="<?php echo e(route('laporan.index')); ?>" class="dashboard-link-card">
                    <div>
                        <p class="dashboard-link-title">Kelola laporan</p>
                        <p class="dashboard-link-copy">Lihat seluruh tiket, filter status, dan pantau SLA.</p>
                    </div>
                    <svg class="h-5 w-5" style="color: var(--text-tertiary);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
                <a href="<?php echo e(route('laporan.create')); ?>" class="dashboard-link-card">
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
                            <?php $__empty_1 = true; $__currentLoopData = $topTeknisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teknisi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="flex items-center justify-between rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025); transition: all 200ms;">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-semibold" style="background: linear-gradient(135deg, var(--accent), var(--accent-soft)); color: #050508;">
                                            <?php echo e(strtoupper(substr($teknisi->name, 0, 1))); ?>

                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold" style="color: var(--text-primary);"><?php echo e($teknisi->name); ?></p>
                                            <p class="text-xs" style="color: var(--text-tertiary);"><?php echo e($teknisi->email); ?></p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-semibold" style="color: var(--accent);"><?php echo e($teknisi->completed_count); ?> selesai</span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="dashboard-empty py-8">Belum ada data teknisi.</div>
                            <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $departmentStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-center justify-between rounded-2xl px-4 py-3" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                                <div>
                                    <p class="text-sm font-semibold" style="color: var(--text-primary);"><?php echo e($department->department?->name ?? 'Tanpa Department'); ?></p>
                                    <p class="text-xs" style="color: var(--text-tertiary);">Total tiket aktif dan historis</p>
                                </div>
                                <span class="text-sm font-semibold" style="color: var(--accent);"><?php echo e($department->count); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="dashboard-empty py-8">Belum ada data department.</div>
                        <?php endif; ?>
                    </div>
                </article>
            </section>

            <section class="dashboard-panel overflow-hidden animate-fade-in-up animate-delay-7">
                <div class="dashboard-section-head">
                    <div>
                        <h3 class="dashboard-section-title">Laporan terbaru</h3>
                        <p class="dashboard-section-copy">Daftar tiket terbaru untuk monitoring cepat.</p>
                    </div>
                    <a href="<?php echo e(route('laporan.index')); ?>" class="text-sm font-medium transition" style="color: var(--accent);">Lihat semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>No. Tiket</th><th>Pelapor</th><th>Department</th><th>Prioritas</th><th>Status</th><th>Teknisi</th><th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentLaporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="font-medium" style="color: var(--text-primary);"><?php echo e($laporan->ticket_number); ?></td>
                                    <td><?php echo e($laporan->pelapor->name); ?></td>
                                    <td><?php echo e($laporan->department->name); ?></td>
                                    <td class="capitalize"><?php echo e($laporan->priority); ?></td>
                                    <td><?php echo $__env->make('components.status-badge', ['status' => $laporan->is_overdue ? 'overdue' : $laporan->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                                    <td><?php echo e($laporan->assignment?->teknisi?->name ?? '-'); ?></td>
                                    <td><a href="<?php echo e(route('laporan.show', $laporan)); ?>" class="font-medium" style="color: var(--accent);">Detail</a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="7" class="dashboard-empty">Belum ada laporan terbaru.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartFont = { family: 'Inter, sans-serif' };
        const chartGrid = { color: 'rgba(255,255,255,0.04)', drawBorder: false };
        const chartTicks = { color: 'rgba(238,241,240,0.3)', font: { family: 'Inter, sans-serif', size: 11 } };
        const teal = '#2EC4B6';
        const tealSoft = 'rgba(46,196,182,0.15)';
        const tealMuted = 'rgba(46,196,182,0.5)';
        const dimWhite = 'rgba(238,241,240,0.25)';

        new Chart(document.getElementById('dailyChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chartData['labels']); ?>,
                datasets: [
                    { label:'Dibuat', data:<?php echo json_encode($chartData['created']); ?>, borderColor:teal, backgroundColor:tealSoft, pointRadius:3, pointBackgroundColor:teal, borderWidth:2, tension:0.35, fill:true },
                    { label:'Selesai', data:<?php echo json_encode($chartData['completed']); ?>, borderColor:dimWhite, backgroundColor:'rgba(255,255,255,0.03)', pointRadius:3, pointBackgroundColor:dimWhite, borderWidth:2, tension:0.35, fill:true }
                ]
            },
            options: { responsive:true, plugins:{ legend:{ position:'bottom', labels:{ boxWidth:10, boxHeight:10, usePointStyle:true, pointStyle:'circle', font:chartFont, color:'rgba(238,241,240,0.4)' } } }, scales:{ x:{ grid:{display:false}, ticks:chartTicks }, y:{ beginAtZero:true, grid:chartGrid, ticks:{...chartTicks, stepSize:1} } } }
        });

        new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($monthlyData['labels']); ?>,
                datasets: [
                    { label:'Dibuat', data:<?php echo json_encode($monthlyData['created']); ?>, backgroundColor:teal, borderRadius:8 },
                    { label:'Selesai', data:<?php echo json_encode($monthlyData['completed']); ?>, backgroundColor:'rgba(46,196,182,0.25)', borderRadius:8 }
                ]
            },
            options: { responsive:true, plugins:{ legend:{ position:'bottom', labels:{ boxWidth:10, boxHeight:10, font:chartFont, color:'rgba(238,241,240,0.4)' } } }, scales:{ x:{ grid:{display:false}, ticks:chartTicks }, y:{ beginAtZero:true, grid:chartGrid, ticks:{...chartTicks, stepSize:1} } } }
        });

        new Chart(document.getElementById('priorityChart'), {
            type: 'doughnut',
            data: {
                labels: ['Low','Medium','High','Urgent'],
                datasets: [{ data:<?php echo json_encode(array_values($priorityStats)); ?>, backgroundColor:['rgba(46,196,182,0.2)','rgba(46,196,182,0.4)','rgba(46,196,182,0.65)',teal], borderWidth:0 }]
            },
            options: { responsive:true, cutout:'65%', plugins:{ legend:{ position:'bottom', labels:{ boxWidth:10, boxHeight:10, font:chartFont, color:'rgba(238,241,240,0.4)' } } } }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>