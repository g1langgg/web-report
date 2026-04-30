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
                <p class="dashboard-eyebrow">Dashboard Teknisi</p>
                <h2 class="dashboard-title">Fokus ke pekerjaan yang paling penting</h2>
                <p class="dashboard-subtitle">Semua assignment aktif dan laporan yang bisa diambil diringkas di sini.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="dashboard-badge">Sedang dikerjakan: <?php echo e($stats['my_progress']); ?></span>
                <span class="dashboard-badge">Tersedia: <?php echo e($stats['available']); ?></span>

            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="dashboard-shell">
        <div class="dashboard-stack">
            <section class="dashboard-hero animate-fade-in-up">
                <div class="dashboard-hero-content grid gap-8 xl:grid-cols-[1.15fr_0.85fr] xl:items-end">
                    <div>
                        <p class="dashboard-hero-kicker">Focus Mode</p>
                        <h3 class="dashboard-hero-title">Assignment aktif dan tiket yang tersedia untuk diambil.</h3>
                        <p class="dashboard-hero-copy">Lanjutkan pekerjaan yang sedang berjalan atau ambil tiket baru.</p>
                        <div class="mt-6 flex flex-wrap gap-2">
                            <span class="dashboard-chip-dark"><?php echo e($stats['my_progress']); ?> assignment aktif</span>
                            <span class="dashboard-chip-dark"><?php echo e($stats['available']); ?> tiket tersedia</span>

                        </div>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-1">
                        <div class="dashboard-floating-note">
                            <p class="dashboard-inline-label">Lanjut sekarang</p>
                            <p class="mt-2 text-2xl font-semibold tracking-tight" style="color: var(--text-primary);"><?php echo e($stats['my_progress']); ?></p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Assignment yang paling butuh perhatianmu sekarang.</p>
                        </div>
                        <div class="dashboard-floating-note">
                            <p class="dashboard-inline-label">Siap diambil</p>
                            <p class="mt-2 text-2xl font-semibold tracking-tight" style="color: var(--text-primary);"><?php echo e($stats['available']); ?></p>
                            <p class="mt-2 text-sm" style="color: var(--text-secondary);">Gabungan tiket baru dan tiket revisi.</p>
                        </div>
                    </div>
                </div>
                <div class="dashboard-hero-metrics">
                    <div class="dashboard-hero-metric">
                        <p class="dashboard-hero-metric-label">Progress aktif</p>
                        <p class="dashboard-hero-metric-value"><?php echo e($stats['my_progress']); ?></p>
                        <p class="dashboard-hero-metric-copy">Tiket yang sedang berjalan atas nama kamu.</p>
                    </div>
                    <div class="dashboard-hero-metric">
                        <p class="dashboard-hero-metric-label">Selesai</p>
                        <p class="dashboard-hero-metric-value"><?php echo e($stats['my_completed']); ?></p>
                        <p class="dashboard-hero-metric-copy">Riwayat assignment yang sudah ditutup.</p>
                    </div>

                </div>
            </section>

            <section class="grid grid-cols-1 gap-4 xl:grid-cols-[1.4fr_1fr] animate-fade-in-up animate-delay-1">
                <article class="dashboard-panel p-6">
                    <p class="dashboard-stat-label">Prioritas utama</p>
                    <div class="mt-4 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <h3 class="text-2xl font-semibold tracking-tight" style="color: var(--text-primary);">Assignment aktif yang perlu dilanjutkan</h3>
                            <p class="mt-2 max-w-xl text-sm leading-6" style="color: var(--text-secondary);">Tiket yang sudah di-assign ke kamu dan masih dalam proses pengerjaan.</p>
                            <div class="mt-6 flex items-end gap-4">
                                <p class="text-5xl font-semibold tracking-tight" style="color: var(--text-primary);"><?php echo e($stats['my_progress']); ?></p>
                                <p class="pb-2 text-sm" style="color: var(--text-secondary);">laporan aktif</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <?php if($stats['my_progress'] > 0): ?>
                                <a href="<?php echo e(route('laporan.index', ['status' => 'progress', 'assigned_to' => auth()->id()])); ?>" class="inline-flex items-center rounded-2xl px-4 py-3 text-sm font-medium transition" style="background: linear-gradient(135deg, var(--accent), var(--accent-soft)); color: #050508;">
                                    Lanjutkan pekerjaan
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('laporan.index', ['status' => 'pending', 'available' => 1])); ?>" class="inline-flex items-center rounded-2xl px-4 py-3 text-sm font-medium transition" style="border: 1px solid var(--border); background: var(--bg-card); color: var(--text-primary);">
                                Ambil laporan baru
                            </a>
                        </div>
                    </div>
                </article>

                <article class="dashboard-tonal-card">
                    <p class="dashboard-stat-label">Kapasitas hari ini</p>
                    <div class="mt-4 space-y-4">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--text-tertiary);">Laporan tersedia</p>
                            <p class="mt-2 text-4xl font-semibold" style="color: var(--text-primary);"><?php echo e($stats['available']); ?></p>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="dashboard-inline-stat">
                                <p class="dashboard-inline-label">Pending</p>
                                <p class="dashboard-inline-value"><?php echo e($stats['pending']); ?></p>
                            </div>
                            <div class="dashboard-inline-stat">
                                <p class="dashboard-inline-label">Revisi</p>
                                <p class="dashboard-inline-value"><?php echo e($stats['reopened']); ?></p>
                            </div>
                        </div>
                    </div>
                </article>
            </section>

            <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4 animate-fade-in-up animate-delay-2">
                <?php $tekCards = [
                    ['label'=>'Tugas aktif','value'=>$stats['my_progress'],'meta'=>'Sedang dikerjakan sekarang','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M4 13h4l3-8 4 14 3-6h2"/>'],
                    ['label'=>'Selesai','value'=>$stats['my_completed'],'meta'=>'Riwayat assignment selesai','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>'],
                ]; ?>
                <?php $__currentLoopData = $tekCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="dashboard-stat-card">
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

            <section class="grid grid-cols-1 gap-4 md:grid-cols-2 animate-fade-in-up animate-delay-3">
                <a href="<?php echo e(route('laporan.index', ['status' => 'pending', 'available' => 1])); ?>" class="dashboard-link-card">
                    <div><p class="dashboard-link-title">Ambil laporan</p><p class="dashboard-link-copy">Lihat tiket yang belum ditangani dan bisa langsung kamu ambil.</p></div>
                    <svg class="h-5 w-5" style="color: var(--text-tertiary);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
                <a href="<?php echo e(route('laporan.index', ['assigned_to' => auth()->id()])); ?>" class="dashboard-link-card">
                    <div><p class="dashboard-link-title">Assignment saya</p><p class="dashboard-link-copy">Buka semua tiket yang sudah pernah atau sedang kamu kerjakan.</p></div>
                    <svg class="h-5 w-5" style="color: var(--text-tertiary);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                </a>
            </section>

            <?php if(isset($chartData) && count($chartData['labels']) > 0): ?>
                <section class="dashboard-panel p-5 animate-fade-in-up animate-delay-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="dashboard-section-title">Performa 7 hari terakhir</h3>
                            <p class="dashboard-section-copy">Jumlah assignment yang selesai per hari.</p>
                        </div>
                        <span class="dashboard-badge">Produktivitas</span>
                    </div>
                    <div class="mt-5"><canvas id="teknisiChart" height="110"></canvas></div>
                </section>
            <?php endif; ?>

            <section class="grid grid-cols-1 gap-6 xl:grid-cols-[1.2fr_1fr] animate-fade-in-up animate-delay-5">
                <article class="dashboard-panel overflow-hidden">
                    <div class="dashboard-section-head">
                        <div>
                            <h3 class="dashboard-section-title">Laporan tersedia</h3>
                            <p class="dashboard-section-copy">Tiket yang bisa segera kamu ambil.</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="dashboard-table">
                            <thead><tr><th>No. Tiket</th><th>Status</th><th>Department</th><th>Lokasi</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $availableLaporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="font-medium" style="color: var(--text-primary);"><?php echo e($laporan->ticket_number); ?></td>
                                        <td class="capitalize"><?php echo e($laporan->status === 'reopened' ? 'Revisi' : 'Baru'); ?></td>
                                        <td><?php echo e($laporan->department->name); ?></td>
                                        <td><?php echo e($laporan->location); ?></td>
                                        <td class="max-w-xs truncate"><?php echo e($laporan->description); ?></td>
                                        <td>
                                            <form action="<?php echo e(route('laporan.assign', $laporan)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="teknisi_id" value="<?php echo e(auth()->id()); ?>">
                                                <button type="submit" class="rounded-xl px-3 py-2 text-xs font-medium transition" style="background: linear-gradient(135deg, var(--accent), var(--accent-soft)); color: #050508;">
                                                    <?php echo e($laporan->status === 'reopened' ? 'Ambil revisi' : 'Ambil'); ?>

                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="6" class="dashboard-empty">Tidak ada laporan yang tersedia saat ini.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </article>

                <article class="dashboard-panel overflow-hidden">
                    <div class="dashboard-section-head">
                        <div>
                            <h3 class="dashboard-section-title">Maintenance hari ini</h3>
                            <p class="dashboard-section-copy">Daftar task maintenance milikmu.</p>
                        </div>
                        <a href="<?php echo e(route('maintenance.tasks.index')); ?>" class="text-sm font-medium" style="color: var(--accent);">Lihat semua</a>
                    </div>
                    <div class="space-y-3 px-5 py-4">
                        <?php $__empty_1 = true; $__currentLoopData = $todayMaintenanceTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="rounded-2xl px-4 py-4" style="border: 1px solid var(--border); background: rgba(255,255,255,0.025);">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="text-sm font-semibold" style="color: var(--text-primary);"><?php echo e($task->schedule->nama_tugas); ?></p>
                                    <span class="rounded-full px-3 py-1 text-xs font-medium" style="background: var(--accent-glow); color: var(--accent); border: 1px solid var(--accent-border);"><?php echo e(ucfirst($task->status)); ?></span>
                                </div>
                                <p class="mt-2 text-sm" style="color: var(--text-secondary);"><?php echo e($task->schedule->lokasi); ?> · <?php echo e(ucfirst($task->schedule->frekuensi)); ?></p>
                                <a href="<?php echo e(route('maintenance.tasks.show', $task)); ?>" class="mt-3 inline-flex text-sm font-medium" style="color: var(--accent);">Buka task</a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="dashboard-empty py-8">Tidak ada task maintenance hari ini.</div>
                        <?php endif; ?>
                    </div>
                </article>
            </section>

            <section class="dashboard-panel overflow-hidden animate-fade-in-up animate-delay-6">
                <div class="dashboard-section-head">
                    <div>
                        <h3 class="dashboard-section-title">Assignment saya</h3>
                        <p class="dashboard-section-copy">Ringkasan tiket yang sudah kamu pegang.</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="dashboard-table">
                        <thead><tr><th>No. Tiket</th><th>Department</th><th>Lokasi</th><th>Status</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $myAssignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="font-medium" style="color: var(--text-primary);"><?php echo e($assignment->laporan->ticket_number); ?></td>
                                    <td><?php echo e($assignment->laporan->department->name); ?></td>
                                    <td><?php echo e($assignment->laporan->location); ?></td>
                                    <td><?php echo $__env->make('components.status-badge', ['status' => $assignment->laporan->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                                    <td><a href="<?php echo e(route('laporan.show', $assignment->laporan)); ?>" class="font-medium" style="color: var(--accent);">Detail</a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="5" class="dashboard-empty">Belum ada assignment aktif maupun riwayat terbaru.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <?php if(isset($chartData) && count($chartData['labels']) > 0): ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            new Chart(document.getElementById('teknisiChart'), {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($chartData['labels']); ?>,
                    datasets: [{ label:'Laporan selesai', data:<?php echo json_encode($chartData['completed']); ?>, backgroundColor:'#2EC4B6', borderRadius:8, maxBarThickness:36 }]
                },
                options: {
                    responsive:true,
                    plugins:{ legend:{ position:'bottom', labels:{ color:'rgba(238,241,240,0.4)', font:{ family:'Inter, sans-serif' } } } },
                    scales:{
                        x:{ grid:{display:false}, ticks:{ color:'rgba(238,241,240,0.3)', font:{ family:'Inter, sans-serif', size:11 } } },
                        y:{ beginAtZero:true, grid:{ color:'rgba(255,255,255,0.04)', drawBorder:false }, ticks:{ stepSize:1, color:'rgba(238,241,240,0.3)', font:{ family:'Inter, sans-serif', size:11 } } }
                    }
                }
            });
        </script>
    <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/dashboard/teknisi.blade.php ENDPATH**/ ?>