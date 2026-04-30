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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 dark:text-white">Detail Task Maintenance</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5"><?php echo e($task->schedule->nama_tugas); ?></p>
                </div>
            </div>
            <a href="<?php echo e(route('maintenance.tasks.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Task Info Card -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white"><?php echo e($task->schedule->nama_tugas); ?></h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Jadwal: <?php echo e($task->tanggal_jadwal->format('d/m/Y')); ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <?php
                                $statusColors = [
                                    'pending' => 'bg-amber-100 text-amber-800',
                                    'ongoing' => 'bg-blue-100 text-blue-800',
                                    'completed' => 'bg-emerald-100 text-emerald-800',
                                    'missed' => 'bg-red-100 text-red-800',
                                ];
                            ?>
                            <span class="px-3 py-1 rounded-full text-sm font-medium <?php echo e($statusColors[$task->status]); ?>">
                                <?php echo e(ucfirst($task->status)); ?>

                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Lokasi</p>
                            <p class="font-medium text-gray-900 dark:text-white"><?php echo e($task->schedule->lokasi); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Frekuensi</p>
                            <p class="font-medium text-gray-900 dark:text-white"><?php echo e(ucfirst($task->schedule->frekuensi)); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Teknisi</p>
                            <p class="font-medium text-gray-900 dark:text-white"><?php echo e($task->schedule->teknisi->name); ?></p>
                        </div>
                        <div>
                            <p class="text-gray-500 dark:text-gray-400">Progress Checklist</p>
                            <div class="flex items-center gap-2">
                                <div class="w-20 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-500" style="width: <?php echo e($task->getCompletionPercentage()); ?>%"></div>
                                </div>
                                <span class="font-medium"><?php echo e($task->getCompletionPercentage()); ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start Task Button (if pending) -->
            <?php if($task->isPending()): ?>
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-2xl p-6 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-semibold text-blue-900 dark:text-blue-100">Siap memulai task?</h4>
                            <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">Klik tombol Mulai untuk memulai pengecekan maintenance.</p>
                        </div>
                        <form action="<?php echo e(route('maintenance.tasks.start', $task)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Mulai Task
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Checklist Section -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="font-semibold text-gray-900 dark:text-white">Checklist Pengecekan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Centang semua item yang sudah dicek</p>
                </div>

                <div class="divide-y divide-gray-200 dark:divide-slate-700">
                    <?php $__empty_1 = true; $__currentLoopData = $task->taskChecklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskChecklist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="p-4 flex items-start gap-4 <?php echo e($task->isCompleted() ? '' : 'hover:bg-gray-50 dark:hover:bg-slate-700/50'); ?>">
                            <div class="flex-shrink-0 pt-1">
                                <?php if($task->isCompleted()): ?>
                                    <?php if($taskChecklist->is_checked): ?>
                                        <svg class="w-6 h-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    <?php else: ?>
                                        <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <input type="checkbox"
                                        class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                        <?php echo e($taskChecklist->is_checked ? 'checked' : ''); ?>

                                        <?php echo e($task->isPending() ? 'disabled' : ''); ?>

                                        onchange="updateChecklist(<?php echo e($taskChecklist->id); ?>, this.checked)">
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-white <?php echo e($taskChecklist->is_checked ? 'line-through text-gray-500' : ''); ?>">
                                    <?php echo e($taskChecklist->checklist->item_name); ?>

                                    <?php if($taskChecklist->checklist->is_required): ?>
                                        <span class="text-red-500">*</span>
                                    <?php endif; ?>
                                </p>
                                <?php if($taskChecklist->checklist->deskripsi): ?>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1"><?php echo e($taskChecklist->checklist->deskripsi); ?></p>
                                <?php endif; ?>
                                <?php if(!$task->isCompleted() && $task->isOngoing()): ?>
                                    <input type="text"
                                        placeholder="Catatan (opsional)"
                                        class="mt-2 text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white w-full md:w-1/2"
                                        value="<?php echo e($taskChecklist->notes); ?>"
                                        onchange="updateChecklistNotes(<?php echo e($taskChecklist->id); ?>, this.value)">
                                <?php elseif($taskChecklist->notes): ?>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 italic">Catatan: <?php echo e($taskChecklist->notes); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                            <p>Belum ada checklist untuk task ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Complete Task Section -->
            <?php if($task->isOngoing()): ?>
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-slate-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Selesaikan Task</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pilih hasil pengecekan dan berikan catatan</p>
                    </div>

                    <form action="<?php echo e(route('maintenance.tasks.complete', $task)); ?>" method="POST" enctype="multipart/form-data" class="p-6">
                        <?php echo csrf_field(); ?>

                        <!-- Result Status -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                Hasil Pengecekan <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="relative flex cursor-pointer">
                                    <input type="radio" name="result_status" value="normal" class="peer sr-only" required>
                                    <div class="flex-1 p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl peer-checked:border-emerald-500 peer-checked:bg-emerald-50 dark:peer-checked:bg-emerald-900/20 transition-all">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">Normal</p>
                                                <p class="text-xs text-gray-500">Semua kondisi baik</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative flex cursor-pointer">
                                    <input type="radio" name="result_status" value="need_repair" class="peer sr-only">
                                    <div class="flex-1 p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl peer-checked:border-orange-500 peer-checked:bg-orange-50 dark:peer-checked:bg-orange-900/20 transition-all">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">Perlu Perbaikan</p>
                                                <p class="text-xs text-gray-500">Ada masalah, perlu tindak lanjut</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative flex cursor-pointer">
                                    <input type="radio" name="result_status" value="urgent" class="peer sr-only">
                                    <div class="flex-1 p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl peer-checked:border-red-500 peer-checked:bg-red-50 dark:peer-checked:bg-red-900/20 transition-all">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">Urgent</p>
                                                <p class="text-xs text-gray-500">Masalah serius, perlu segera diperbaiki</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Location & Condition (only for need_repair) -->
                        <div id="repair-details" class="hidden mb-6 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Lokasi Detail <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="location_detail"
                                    class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Contoh: Lantai 2, Ruang Meeting A">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Kondisi/Permasalahan <span class="text-red-500">*</span>
                                </label>
                                <textarea name="condition_detail" rows="3"
                                    class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Jelaskan kondisi yang ditemukan, kerusakan, atau permasalahan..."></textarea>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Catatan Teknisi <span class="text-red-500">*</span>
                            </label>
                            <textarea name="notes" rows="4" required
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                                placeholder="Jelaskan hasil pengecekan, kondisi yang ditemukan, dan tindakan yang diperlukan..."></textarea>
                        </div>

                        <!-- Photo -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Foto (Opsional)
                            </label>
                            <input type="file" name="photo" accept="image/*"
                                class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="flex items-center justify-end gap-3">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all shadow-lg">
                                Selesaikan Task
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <!-- Result Section (if completed) -->
            <?php if($task->isCompleted()): ?>
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Hasil Pengecekan</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Status Hasil</p>
                                <?php
                                    $resultColors = [
                                        'normal' => 'bg-emerald-100 text-emerald-800',
                                        'need_repair' => 'bg-orange-100 text-orange-800',
                                        'urgent' => 'bg-red-100 text-red-800',
                                    ];
                                    $resultLabels = ['normal' => 'Normal', 'need_repair' => 'Perlu Perbaikan', 'urgent' => 'Urgent'];
                                ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo e($resultColors[$task->result_status]); ?>">
                                    <?php echo e($resultLabels[$task->result_status]); ?>

                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Waktu Selesai</p>
                                <p class="font-medium text-gray-900 dark:text-white"><?php echo e($task->completed_at?->format('d/m/Y H:i')); ?></p>
                            </div>

                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Catatan Teknisi</p>
                                <p class="text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg"><?php echo e($task->notes); ?></p>
                            </div>

                            <?php if($task->photo_path): ?>
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Foto</p>
                                    <img src="<?php echo e(Storage::url($task->photo_path)); ?>" alt="Maintenance Photo" class="max-w-md rounded-lg">
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Create Report Button -->
                        <?php if($task->needsRepair() && !$task->report_id): ?>
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-slate-700">
                                <div class="bg-orange-50 dark:bg-orange-900/20 rounded-xl p-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-semibold text-orange-900 dark:text-orange-100">Perlu Membuat Laporan</h4>
                                            <p class="text-sm text-orange-700 dark:text-orange-300 mt-1">Hasil pengecekan menunjukkan perlunya perbaikan. Buat laporan untuk tindak lanjut.</p>
                                        </div>
                                        <form action="<?php echo e(route('maintenance.tasks.create-report', $task)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-lg hover:bg-orange-700 transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Buat Laporan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php elseif($task->report_id): ?>
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-slate-700">
                                <a href="<?php echo e(route('laporan.show', $task->report_id)); ?>" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 text-sm font-medium rounded-lg hover:bg-blue-200 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Lihat Laporan Terkait
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function updateChecklist(taskChecklistId, isChecked) {
            fetch(`/maintenance/tasks/<?php echo e($task->id); ?>/checklist/${taskChecklistId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ is_checked: isChecked })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update progress display
                    location.reload();
                }
            });
        }

        // Show/hide repair details based on result selection
        document.querySelectorAll('input[name="result_status"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const repairDetails = document.getElementById('repair-details');
                if (this.value === 'need_repair') {
                    repairDetails.classList.remove('hidden');
                    repairDetails.querySelectorAll('input, textarea').forEach(field => {
                        field.setAttribute('required', 'required');
                    });
                } else {
                    repairDetails.classList.add('hidden');
                    repairDetails.querySelectorAll('input, textarea').forEach(field => {
                        field.removeAttribute('required');
                    });
                }
            });
        });

        function updateChecklistNotes(taskChecklistId, notes) {
            fetch(`/maintenance/tasks/<?php echo e($task->id); ?>/checklist/${taskChecklistId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ notes: notes })
            });
        }
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
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/maintenance/tasks/show.blade.php ENDPATH**/ ?>