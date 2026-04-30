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
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-xl sm:text-2xl text-gray-800 dark:text-white">Daftar Laporan</h2>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-0.5"><?php echo e($stats['total']); ?> laporan ditemukan</p>
                </div>
            </div>
            <?php if(auth()->user()->hasRole('pelapor')): ?>
                <a href="<?php echo e(route('laporan.create')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-medium rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg self-start sm:self-auto">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Buat Laporan
                </a>
            <?php endif; ?>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Total</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo e($stats['total']); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-amber-600">Pending</p>
                    <p class="text-2xl font-bold text-amber-600"><?php echo e($stats['pending']); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-orange-600">Revisi</p>
                    <p class="text-2xl font-bold text-orange-600"><?php echo e($stats['reopened'] ?? 0); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-blue-600">Progress</p>
                    <p class="text-2xl font-bold text-blue-600"><?php echo e($stats['progress']); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-emerald-600">Done</p>
                    <p class="text-2xl font-bold text-emerald-600"><?php echo e($stats['done']); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-red-600">Overdue</p>
                    <p class="text-2xl font-bold text-red-600"><?php echo e($stats['overdue']); ?></p>
                </div>
            </div>

            <!-- Search & Filter Panel -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden mb-6">
                <div class="p-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-700/50">
                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span class="font-semibold">Filter & Pencarian</span>
                    </div>
                </div>
                <form method="GET" action="<?php echo e(route('laporan.index')); ?>" class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Cari (No.Tiket/Lokasi/Deskripsi)</label>
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari laporan..." class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                            <select name="status" class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                <option value="">Semua Status</option>
                                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="reopened" <?php echo e(request('status') == 'reopened' ? 'selected' : ''); ?>>Revisi</option>
                                <option value="progress" <?php echo e(request('status') == 'progress' ? 'selected' : ''); ?>>Progress</option>
                                <option value="done" <?php echo e(request('status') == 'done' ? 'selected' : ''); ?>>Done</option>
                            </select>
                        </div>

                        <!-- Department Filter -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Department</label>
                            <select name="department_id" class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                <option value="">Semua Department</option>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($dept->id); ?>" <?php echo e(request('department_id') == $dept->id ? 'selected' : ''); ?>><?php echo e($dept->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Priority Filter -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Prioritas</label>
                            <select name="priority" class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                <option value="">Semua Prioritas</option>
                                <option value="low" <?php echo e(request('priority') == 'low' ? 'selected' : ''); ?>>Low</option>
                                <option value="medium" <?php echo e(request('priority') == 'medium' ? 'selected' : ''); ?>>Medium</option>
                                <option value="high" <?php echo e(request('priority') == 'high' ? 'selected' : ''); ?>>High</option>
                                <option value="urgent" <?php echo e(request('priority') == 'urgent' ? 'selected' : ''); ?>>Urgent</option>
                            </select>
                        </div>

                        <!-- Date From -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Dari Tanggal</label>
                            <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        </div>

                        <!-- Date To -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Sampai Tanggal</label>
                            <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                        </div>

                        <!-- Pelapor Filter (for non-pelapor roles) -->
                        <?php if(!auth()->user()->hasRole('pelapor')): ?>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama Pelapor</label>
                                <input type="text" name="pelapor" value="<?php echo e(request('pelapor')); ?>" placeholder="Nama pelapor..." class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                            </div>
                        <?php endif; ?>

                        <!-- Overdue Filter -->
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Overdue</label>
                            <select name="overdue" class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                <option value="">Semua</option>
                                <option value="yes" <?php echo e(request('overdue') == 'yes' ? 'selected' : ''); ?>>Ya (Overdue)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200 dark:border-slate-700">
                        <a href="<?php echo e(route('laporan.index')); ?>" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                            Reset Filter
                        </a>
                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-slate-700/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">No. Tiket</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Tanggal</th>
                                <?php if(!auth()->user()->hasRole('pelapor')): ?>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Pelapor</th>
                                <?php endif; ?>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Prioritas</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Deadline</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                            <?php $__empty_1 = true; $__currentLoopData = $laporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors <?php echo e($laporan->is_overdue ? 'bg-red-50/50 dark:bg-red-900/10' : ''); ?>">
                                    <td class="px-6 py-4">
                                        <span class="font-mono font-medium text-gray-900 dark:text-white"><?php echo e($laporan->ticket_number); ?></span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-slate-400"><?php echo e($laporan->report_date->format('d/m/Y')); ?></td>
                                    <?php if(!auth()->user()->hasRole('pelapor')): ?>
                                        <td class="px-6 py-4 text-gray-700 dark:text-slate-300"><?php echo e($laporan->pelapor->name); ?></td>
                                    <?php endif; ?>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300">
                                            <?php echo e($laporan->department->name); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php
                                            $priorityColors = ['low' => 'text-green-600', 'medium' => 'text-yellow-600', 'high' => 'text-orange-600', 'urgent' => 'text-red-600'];
                                            $priorityLabels = ['low' => 'Low', 'medium' => 'Med', 'high' => 'High', 'urgent' => 'Urgent'];
                                        ?>
                                        <span class="text-xs font-semibold <?php echo e($priorityColors[$laporan->priority] ?? 'text-gray-600'); ?>">
                                            <?php echo e($priorityLabels[$laporan->priority] ?? $laporan->priority); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4"><?php echo $__env->make('components.status-badge', ['status' => $laporan->is_overdue ? 'overdue' : $laporan->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                                    <td class="px-6 py-4">
                                        <?php if($laporan->deadline): ?>
                                            <span class="text-xs <?php echo e($laporan->is_overdue ? 'text-red-600 font-semibold' : 'text-gray-600 dark:text-slate-400'); ?>">
                                                <?php echo e($laporan->deadline->format('d/m H:i')); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-xs text-gray-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <a href="<?php echo e(route('laporan.show', $laporan)); ?>" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 font-medium text-sm">
                                                Detail
                                                <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                            
                                            <?php if(auth()->user()->hasRole('teknisi') && in_array($laporan->status, ['pending', 'reopened'])): ?>
                                                <form action="<?php echo e(route('laporan.assign', $laporan)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="teknisi_id" value="<?php echo e(auth()->id()); ?>">
                                                    <button type="submit" class="text-xs font-bold text-emerald-600 hover:text-emerald-900 dark:text-emerald-400 ml-2">
                                                        Ambil
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="<?php echo e(auth()->user()->hasRole('pelapor') ? 7 : 8); ?>" class="px-6 py-16 text-center">
                                        <div class="relative">
                                            <div class="absolute inset-0 bg-gradient-to-b from-gray-50/50 to-transparent dark:from-slate-700/20 rounded-2xl"></div>
                                            <div class="relative">
                                                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-slate-700 dark:to-slate-600 rounded-2xl flex items-center justify-center mb-4 shadow-inner">
                                                    <svg class="w-12 h-12 text-gray-400 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                        <polyline points="14 2 14 8 20 8"/>
                                                        <path d="M8 13h2m-2 4h2m6-4h.01M16 13h.01"/>
                                                    </svg>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-900 dark:text-white mb-1">📭 Belum ada laporan</p>
                                                <p class="text-sm text-gray-500 dark:text-slate-400 mb-4 max-w-xs mx-auto">
                                                    <?php if(request()->hasAny(['search', 'status', 'department_id', 'priority', 'date_from', 'date_to'])): ?>
                                                        Coba sesuaikan filter pencarian untuk menemukan laporan.
                                                    <?php else: ?>
                                                        Semua kondisi aman 👍<br>Tidak ada laporan yang perlu ditangani saat ini.
                                                    <?php endif; ?>
                                                </p>
                                                <?php if(auth()->user()->hasRole('pelapor') && !request()->hasAny(['search', 'status'])): ?>
                                                    <a href="<?php echo e(route('laporan.create')); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                                                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                                        </svg>
                                                        Buat Laporan Baru
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700">
                    <?php echo e($laporans->links()); ?>

                </div>
            </div>
        </div>
    </div>
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
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/laporan/index.blade.php ENDPATH**/ ?>