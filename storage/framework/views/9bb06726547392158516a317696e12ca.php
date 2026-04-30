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
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 dark:text-white">Task Maintenance</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Daftar tugas preventive maintenance hari ini</p>
                </div>
            </div>
            <?php if(auth()->user()->hasRole(['admin', 'manager', 'pelapor'])): ?>
                <a href="<?php echo e(route('maintenance.schedules.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all shadow-md">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">Kelola Jadwal</span>
                </a>
            <?php endif; ?>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Messages -->
            <?php if(session('success')): ?>
                <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-emerald-800 dark:text-emerald-200"><?php echo e(session('success')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('warning')): ?>
                <div class="mb-6 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-amber-800 dark:text-amber-200"><?php echo e(session('warning')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-red-800 dark:text-red-200"><?php echo e(session('error')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 mb-6">
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo e($stats['today_total']); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-amber-600">Pending</p>
                    <p class="text-2xl font-bold text-amber-600"><?php echo e($stats['today_pending']); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-blue-600">Sedang Dikerjakan</p>
                    <p class="text-2xl font-bold text-blue-600"><?php echo e($stats['today_ongoing']); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-emerald-600">Selesai</p>
                    <p class="text-2xl font-bold text-emerald-600"><?php echo e($stats['today_completed']); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-orange-600">Butuh Perbaikan</p>
                    <p class="text-2xl font-bold text-orange-600"><?php echo e($stats['need_repair']); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <p class="text-xs text-red-600">Urgent</p>
                    <p class="text-2xl font-bold text-red-600"><?php echo e($stats['urgent']); ?></p>
                </div>
            </div>

            <!-- Tasks Table -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-700/50">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold text-gray-800 dark:text-white">Daftar Task</h3>
                        <div class="flex gap-2">
                            <a href="?status=pending" class="px-3 py-1 text-xs font-medium rounded-full <?php echo e(request('status') == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">Pending</a>
                            <a href="?status=ongoing" class="px-3 py-1 text-xs font-medium rounded-full <?php echo e(request('status') == 'ongoing' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">Ongoing</a>
                            <a href="?status=completed" class="px-3 py-1 text-xs font-medium rounded-full <?php echo e(request('status') == 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">Completed</a>
                            <a href="<?php echo e(route('maintenance.tasks.index')); ?>" class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">Semua</a>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-slate-700/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Nama Tugas</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Lokasi</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Status Task</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Hasil</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Progress</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                            <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-900 dark:text-white"><?php echo e($task->tanggal_jadwal->format('d/m/Y')); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo e($task->tanggal_jadwal->diffForHumans()); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-900 dark:text-white"><?php echo e($task->schedule->nama_tugas); ?></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs"><?php echo e($task->schedule->frekuensi); ?></p>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-slate-300"><?php echo e($task->schedule->lokasi); ?></td>
                                    <td class="px-6 py-4">
                                        <?php
                                            $statusColors = [
                                                'pending' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300',
                                                'ongoing' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
                                                'completed' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300',
                                                'missed' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                            ];
                                            $statusLabels = ['pending' => 'Pending', 'ongoing' => 'Ongoing', 'completed' => 'Completed', 'missed' => 'Missed'];
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($statusColors[$task->status]); ?>">
                                            <?php echo e($statusLabels[$task->status]); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($task->result_status): ?>
                                            <?php
                                                $resultColors = [
                                                    'normal' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                                    'need_repair' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300',
                                                    'urgent' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                                ];
                                                $resultLabels = ['normal' => 'Normal', 'need_repair' => 'Perlu Perbaikan', 'urgent' => 'Urgent'];
                                            ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($resultColors[$task->result_status]); ?>">
                                                <?php echo e($resultLabels[$task->result_status]); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-gray-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php
                                            $progress = $task->getCompletionPercentage();
                                            $progressColor = $progress == 100 ? 'bg-emerald-500' : ($progress >= 50 ? 'bg-blue-500' : 'bg-amber-500');
                                        ?>
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 h-2 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full <?php echo e($progressColor); ?> transition-all duration-300" style="width: <?php echo e($progress); ?>%"></div>
                                            </div>
                                            <span class="text-xs text-gray-600 dark:text-gray-400"><?php echo e($progress); ?>%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if(auth()->user()->hasRole('teknisi')): ?>
                                            <a href="<?php echo e(route('maintenance.tasks.show', $task)); ?>" class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-lg hover:bg-blue-200 transition-colors">
                                                <?php if($task->isPending()): ?>
                                                    Mulai
                                                <?php elseif($task->isOngoing()): ?>
                                                    Lanjutkan
                                                <?php else: ?>
                                                    Detail
                                                <?php endif; ?>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('maintenance.tasks.show', $task)); ?>" class="inline-flex items-center px-3 py-1.5 bg-emerald-100 text-emerald-700 text-xs font-medium rounded-lg hover:bg-emerald-200 transition-colors">
                                                <?php echo e($task->isCompleted() ? 'Lihat Hasil' : 'Detail'); ?>

                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="relative">
                                            <div class="absolute inset-0 bg-gradient-to-b from-gray-50/50 to-transparent dark:from-slate-700/20 rounded-2xl"></div>
                                            <div class="relative">
                                                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-slate-700 dark:to-slate-600 rounded-2xl flex items-center justify-center mb-4 shadow-inner">
                                                    <svg class="w-12 h-12 text-gray-400 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                                        <circle cx="12" cy="12" r="10"/>
                                                    </svg>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-900 dark:text-white mb-1">🧰 Tidak ada task maintenance</p>
                                                <p class="text-sm text-gray-500 dark:text-slate-400 mb-4 max-w-xs mx-auto">
                                                    Semua tugas sudah selesai atau belum ada jadwal untuk periode ini.
                                                </p>
                                                <a href="<?php echo e(route('maintenance.schedules.index')); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 002 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2"/>
                                                    </svg>
                                                    Lihat Jadwal Maintenance
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-slate-700">
                    <?php echo e($tasks->links()); ?>

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
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/maintenance/tasks/index.blade.php ENDPATH**/ ?>