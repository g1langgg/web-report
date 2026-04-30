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
                <div class="p-2 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 dark:text-white">Edit Jadwal Maintenance</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Ubah data jadwal maintenance</p>
                </div>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="<?php echo e(route('maintenance.schedules.index')); ?>" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Jadwal</span>
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-200 dark:border-slate-700 overflow-hidden">
                <div class="p-8">
                    <form action="<?php echo e(route('maintenance.schedules.update', $schedule)); ?>" method="POST" id="scheduleForm">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Nama Tugas -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Tugas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_tugas" required
                                    value="<?php echo e(old('nama_tugas', $schedule->nama_tugas)); ?>"
                                    class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Contoh: Pengecekan Pompa Air">
                                <?php $__errorArgs = ['nama_tugas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Frekuensi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Frekuensi <span class="text-red-500">*</span>
                                </label>
                                <select name="frekuensi" required
                                    class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="daily" <?php echo e(old('frekuensi', $schedule->frekuensi) == 'daily' ? 'selected' : ''); ?>>Daily (Harian)</option>
                                    <option value="weekly" <?php echo e(old('frekuensi', $schedule->frekuensi) == 'weekly' ? 'selected' : ''); ?>>Weekly (Mingguan)</option>
                                    <option value="monthly" <?php echo e(old('frekuensi', $schedule->frekuensi) == 'monthly' ? 'selected' : ''); ?>>Monthly (Bulanan)</option>
                                </select>
                                <?php $__errorArgs = ['frekuensi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Lokasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="lokasi" required
                                    value="<?php echo e(old('lokasi', $schedule->lokasi)); ?>"
                                    class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Contoh: Lantai 1 - Ruang Pompa">
                                <?php $__errorArgs = ['lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Teknisi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Teknisi <span class="text-red-500">*</span>
                                </label>
                                <select name="teknisi_id" required
                                    class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="">Pilih Teknisi</option>
                                    <?php $__currentLoopData = $teknisis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teknisi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($teknisi->id); ?>" <?php echo e(old('teknisi_id', $schedule->teknisi_id) == $teknisi->id ? 'selected' : ''); ?>>
                                            <?php echo e($teknisi->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['teknisi_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Status Aktif -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Status
                                </label>
                                <div class="flex items-center gap-4 mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $schedule->is_active) ? 'checked' : ''); ?>

                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Jadwal Aktif</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Deskripsi
                                </label>
                                <textarea name="deskripsi" rows="3"
                                    class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Jelaskan detail tugas maintenance..."><?php echo e(old('deskripsi', $schedule->deskripsi)); ?></textarea>
                            </div>
                        </div>

                        <!-- Checklist Items -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Checklist Item</h3>
                                <button type="button" onclick="addChecklistItem()"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors text-sm font-medium">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Tambah Item
                                </button>
                            </div>

                            <div id="checklistContainer" class="space-y-3">
                                <?php $__currentLoopData = $schedule->checklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $checklist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="checklist-item flex items-start gap-3 p-3 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                                        <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-3">
                                            <input type="hidden" name="checklists[<?php echo e($index); ?>][id]" value="<?php echo e($checklist->id); ?>">
                                            <input type="text" name="checklists[<?php echo e($index); ?>][item_name]" required
                                                value="<?php echo e($checklist->item_name); ?>"
                                                class="md:col-span-2 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white text-sm"
                                                placeholder="Nama item checklist">
                                            <div class="flex items-center gap-2">
                                                <label class="inline-flex items-center text-sm">
                                                    <input type="checkbox" name="checklists[<?php echo e($index); ?>][is_required]" value="1" <?php echo e($checklist->is_required ? 'checked' : ''); ?>

                                                        class="rounded border-gray-300 text-blue-600">
                                                    <span class="ml-1 text-gray-600 dark:text-gray-400">Wajib</span>
                                                </label>
                                            </div>
                                            <textarea name="checklists[<?php echo e($index); ?>][deskripsi]" rows="2"
                                                class="md:col-span-3 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white text-sm"
                                                placeholder="Deskripsi item (opsional)"><?php echo e($checklist->deskripsi); ?></textarea>
                                        </div>
                                        <button type="button" onclick="removeChecklistItem(this)"
                                            class="text-red-500 hover:text-red-700 p-1">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all shadow-lg">
                                Simpan Perubahan
                            </button>
                            <a href="<?php echo e(route('maintenance.schedules.index')); ?>"
                                class="px-6 py-3 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let checklistCount = <?php echo e($schedule->checklists->count()); ?>;

        function addChecklistItem() {
            const container = document.getElementById('checklistContainer');
            const div = document.createElement('div');
            div.className = 'checklist-item flex items-start gap-3 p-3 bg-gray-50 dark:bg-slate-700/50 rounded-lg';
            div.innerHTML = `
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-3">
                    <input type="text" name="checklists[${checklistCount}][item_name]" required
                        class="md:col-span-2 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white text-sm"
                        placeholder="Nama item checklist">
                    <div class="flex items-center gap-2">
                        <label class="inline-flex items-center text-sm">
                            <input type="checkbox" name="checklists[${checklistCount}][is_required]" value="1" checked
                                class="rounded border-gray-300 text-blue-600">
                            <span class="ml-1 text-gray-600 dark:text-gray-400">Wajib</span>
                        </label>
                    </div>
                    <textarea name="checklists[${checklistCount}][deskripsi]" rows="2"
                        class="md:col-span-3 border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white text-sm"
                        placeholder="Deskripsi item (opsional)"></textarea>
                </div>
                <button type="button" onclick="removeChecklistItem(this)"
                    class="text-red-500 hover:text-red-700 p-1">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            `;
            container.appendChild(div);
            checklistCount++;
        }

        function removeChecklistItem(button) {
            button.closest('.checklist-item').remove();
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
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/maintenance/schedules/edit.blade.php ENDPATH**/ ?>