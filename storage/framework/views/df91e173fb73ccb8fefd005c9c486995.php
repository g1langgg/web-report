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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 dark:text-white">Tambah Jadwal Maintenance</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Buat jadwal preventive maintenance baru</p>
                </div>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                <form action="<?php echo e(route('maintenance.schedules.store')); ?>" method="POST" class="p-6">
                    <?php echo csrf_field(); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Tugas -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Tugas <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_tugas" value="<?php echo e(old('nama_tugas')); ?>" required
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200"
                                placeholder="Contoh: Pengecekan Pompa Air">
                            <?php $__errorArgs = ['nama_tugas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
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
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200">
                                <option value="">Pilih Frekuensi</option>
                                <option value="daily" <?php echo e(old('frekuensi') == 'daily' ? 'selected' : ''); ?>>Daily (Harian)</option>
                                <option value="weekly" <?php echo e(old('frekuensi') == 'weekly' ? 'selected' : ''); ?>>Weekly (Mingguan)</option>
                                <option value="monthly" <?php echo e(old('frekuensi') == 'monthly' ? 'selected' : ''); ?>>Monthly (Bulanan)</option>
                            </select>
                            <?php $__errorArgs = ['frekuensi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
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
                            <input type="text" name="lokasi" value="<?php echo e(old('lokasi')); ?>" required
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200"
                                placeholder="Contoh: Lantai 1 - Ruang Pompa">
                            <?php $__errorArgs = ['lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
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
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200">
                                <option value="">Pilih Teknisi</option>
                                <?php $__currentLoopData = $teknisis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teknisi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($teknisi->id); ?>" <?php echo e(old('teknisi_id') == $teknisi->id ? 'selected' : ''); ?>>
                                        <?php echo e($teknisi->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['teknisi_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Waktu Mulai -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Waktu Mulai (Opsional)
                            </label>
                            <input type="time" name="waktu_mulai" value="<?php echo e(old('waktu_mulai')); ?>"
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200">
                            <?php $__errorArgs = ['waktu_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" rows="3"
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200"
                                placeholder="Deskripsi tugas maintenance..."><?php echo e(old('deskripsi')); ?></textarea>
                            <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Status Aktif -->
                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', true) ? 'checked' : ''); ?>

                                    class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Jadwal Aktif</span>
                            </label>
                        </div>
                    </div>

                    <!-- Checklist Items -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-slate-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Checklist Items</h3>
                            <button type="button" onclick="addChecklistItem()" class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 text-sm font-medium rounded-lg hover:bg-blue-200 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Tambah Item
                            </button>
                        </div>

                        <div id="checklist-container">
                            <?php if(old('checklists')): ?>
                                <?php $__currentLoopData = old('checklists'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $checklist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="checklist-item bg-gray-50 dark:bg-slate-700/50 rounded-lg p-4 mb-3">
                                        <div class="flex items-start gap-4">
                                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama Item</label>
                                                    <input type="text" name="checklists[<?php echo e($index); ?>][item_name]" value="<?php echo e($checklist['item_name']); ?>" required
                                                        class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white"
                                                        placeholder="Contoh: Tekanan air normal">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Deskripsi (Opsional)</label>
                                                    <input type="text" name="checklists[<?php echo e($index); ?>][deskripsi]" value="<?php echo e($checklist['deskripsi'] ?? ''); ?>"
                                                        class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white"
                                                        placeholder="Penjelasan detail">
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="checklists[<?php echo e($index); ?>][is_required]" value="1" <?php echo e(($checklist['is_required'] ?? true) ? 'checked' : ''); ?>

                                                        class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                                                    <span class="ml-1 text-xs text-gray-500">Wajib</span>
                                                </label>
                                                <button type="button" onclick="removeChecklistItem(this)" class="text-red-500 hover:text-red-700">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="checklist-item bg-gray-50 dark:bg-slate-700/50 rounded-lg p-4 mb-3">
                                    <div class="flex items-start gap-4">
                                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama Item</label>
                                                <input type="text" name="checklists[0][item_name]" required
                                                    class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white"
                                                    placeholder="Contoh: Tekanan air normal">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Deskripsi (Opsional)</label>
                                                <input type="text" name="checklists[0][deskripsi]"
                                                    class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white"
                                                    placeholder="Penjelasan detail">
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <label class="flex items-center">
                                                <input type="checkbox" name="checklists[0][is_required]" value="1" checked
                                                    class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                                                <span class="ml-1 text-xs text-gray-500">Wajib</span>
                                            </label>
                                            <button type="button" onclick="removeChecklistItem(this)" class="text-red-500 hover:text-red-700">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-gray-200 dark:border-slate-700">
                        <a href="<?php echo e(route('maintenance.schedules.index')); ?>" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-medium rounded-lg hover:from-amber-600 hover:to-orange-700 transition-all shadow-lg">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let checklistIndex = <?php echo e(old('checklists') ? count(old('checklists')) : 1); ?>;

        function addChecklistItem() {
            const container = document.getElementById('checklist-container');
            const newItem = document.createElement('div');
            newItem.className = 'checklist-item bg-gray-50 dark:bg-slate-700/50 rounded-lg p-4 mb-3';
            newItem.innerHTML = `
                <div class="flex items-start gap-4">
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama Item</label>
                            <input type="text" name="checklists[${checklistIndex}][item_name]" required
                                class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white"
                                placeholder="Contoh: Tekanan air normal">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Deskripsi (Opsional)</label>
                            <input type="text" name="checklists[${checklistIndex}][deskripsi]"
                                class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white"
                                placeholder="Penjelasan detail">
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="checklists[${checklistIndex}][is_required]" value="1" checked
                                class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                            <span class="ml-1 text-xs text-gray-500">Wajib</span>
                        </label>
                        <button type="button" onclick="removeChecklistItem(this)" class="text-red-500 hover:text-red-700">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newItem);
            checklistIndex++;
        }

        function removeChecklistItem(button) {
            const items = document.querySelectorAll('.checklist-item');
            if (items.length > 1) {
                button.closest('.checklist-item').remove();
            } else {
                alert('Minimal harus ada 1 checklist item');
            }
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
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/maintenance/schedules/create.blade.php ENDPATH**/ ?>