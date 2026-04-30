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
                <div class="p-2 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-xl sm:text-2xl text-gray-800 dark:text-white">Detail Laporan</h2>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400"><?php echo e($laporan->ticket_number); ?></p>
                </div>
            </div>
            <div class="self-start sm:self-auto">
                <?php echo $__env->make('components.status-badge', ['status' => $laporan->is_overdue ? 'overdue' : $laporan->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Cards -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-600 rounded-xl">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nomor Tiket</h4>
                            <p class="text-lg font-bold text-gray-900 dark:text-white font-mono"><?php echo e($laporan->ticket_number); ?></p>
                        </div>
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-600 rounded-xl">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Prioritas</h4>
                            <?php
                                $priorityColors = [
                                    'low' => 'text-green-600 bg-green-100 dark:bg-green-900/30',
                                    'medium' => 'text-yellow-600 bg-yellow-100 dark:bg-yellow-900/30',
                                    'high' => 'text-orange-600 bg-orange-100 dark:bg-orange-900/30',
                                    'urgent' => 'text-red-600 bg-red-100 dark:bg-red-900/30',
                                ];
                                $priorityLabels = ['low' => 'Low', 'medium' => 'Medium', 'high' => 'High', 'urgent' => 'Urgent'];
                            ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold <?php echo e($priorityColors[$laporan->priority] ?? 'text-gray-600 bg-gray-100'); ?>">
                                <?php echo e($priorityLabels[$laporan->priority] ?? $laporan->priority); ?>

                            </span>
                        </div>
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-600 rounded-xl <?php echo e($laporan->is_overdue ? 'ring-2 ring-red-500' : ''); ?>">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Deadline</h4>
                            <p class="text-lg font-semibold <?php echo e($laporan->is_overdue ? 'text-red-600' : 'text-gray-900 dark:text-white'); ?>">
                                <?php echo e($laporan->deadline?->format('d M Y H:i') ?? 'N/A'); ?>

                                <?php if($laporan->is_overdue): ?>
                                    <span class="text-xs bg-red-500 text-white px-2 py-0.5 rounded-full ml-2">OVERDUE</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal Laporan</h4>
                            <p class="text-gray-900 dark:text-white"><?php echo e($laporan->report_date->format('d F Y')); ?></p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pelapor</h4>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold">
                                    <?php echo e(substr($laporan->pelapor->name, 0, 1)); ?>

                                </div>
                                <span class="text-gray-900 dark:text-white"><?php echo e($laporan->pelapor->name); ?></span>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Department</h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">
                                <?php echo e($laporan->department->name); ?>

                            </span>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi</h4>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                <span class="text-gray-900 dark:text-white"><?php echo e($laporan->location); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Attachments from Pelapor -->
                    <?php if($laporan->attachments->where('uploaded_by', 'pelapor')->count() > 0): ?>
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Foto Lampiran Pelapor</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <?php $__currentLoopData = $laporan->attachments->where('uploaded_by', 'pelapor'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="relative group cursor-pointer" onclick="openImageModal('<?php echo e(asset('storage/' . $attachment->file_path)); ?>')">
                                        <img src="<?php echo e(asset('storage/' . $attachment->file_path)); ?>" alt="<?php echo e($attachment->file_name); ?>" class="w-full h-32 object-cover rounded-lg">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-600 dark:text-gray-400 mb-2">Deskripsi Masalah</h4>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded">
                            <p class="whitespace-pre-wrap"><?php echo e($laporan->description); ?></p>
                        </div>
                    </div>

                    <?php if($laporan->assignment): ?>
                        <div class="border-t dark:border-gray-600 pt-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-bold text-lg text-gray-900 dark:text-white">Informasi Pengerjaan</h4>
                                <?php if($laporan->status === 'progress'): ?>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-medium text-blue-600 dark:text-blue-400 animate-pulse">Sedang dikerjakan</span>
                                        <span class="flex h-2 w-2 relative">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-slate-700/50 rounded-xl border border-gray-100 dark:border-slate-600">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Teknisi Penanggung Jawab</p>
                                        <p class="font-bold text-gray-900 dark:text-white"><?php echo e($laporan->assignment->teknisi->name); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-slate-700/50 rounded-xl border border-gray-100 dark:border-slate-600">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Waktu Penugasan</p>
                                        <p class="font-bold text-gray-900 dark:text-white"><?php echo e($laporan->assignment->assigned_at?->format('d M Y H:i') ?? '-'); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress Timeline -->
                            <?php if($laporan->progressUpdates->count() > 0): ?>
                                <div class="mb-8">
                                    <h5 class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-4 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                        Catatan Perkembangan (Log)
                                    </h5>
                                    <div class="space-y-4 relative before:absolute before:left-[19px] before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-200 dark:before:bg-slate-700">
                                        <?php $__currentLoopData = $laporan->progressUpdates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="relative pl-10">
                                                <div class="absolute left-3 top-1.5 w-3.5 h-3.5 rounded-full bg-blue-500 border-2 border-white dark:border-slate-800 z-10 shadow-sm shadow-blue-500/50"></div>
                                                <div class="p-4 bg-white dark:bg-slate-800/50 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <span class="text-[10px] font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded">Progres</span>
                                                        <span class="text-[10px] text-gray-500"><?php echo e($update->created_at->format('d M, H:i')); ?></span>
                                                    </div>
                                                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed"><?php echo e($update->message); ?></p>
                                                    <?php if($update->photo_path): ?>
                                                        <div class="mt-3">
                                                            <img src="<?php echo e(asset('storage/' . $update->photo_path)); ?>" alt="Progress Photo" 
                                                                 class="w-32 h-24 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity border dark:border-slate-600"
                                                                 onclick="openImageModal('<?php echo e(asset('storage/' . $update->photo_path)); ?>')">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Final Result Card -->
                            <?php if($laporan->assignment->completed_at): ?>
                                <div class="p-6 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/10 dark:to-teal-900/10 rounded-2xl border-2 border-emerald-100 dark:border-emerald-900/30 shadow-inner">
                                    <div class="flex items-center gap-2 mb-4">
                                        <div class="p-1.5 bg-emerald-500 text-white rounded-lg shadow-sm">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <h5 class="font-bold text-gray-900 dark:text-white">Hasil Pekerjaan Selesai</h5>
                                    </div>
                                    
                                    <div class="space-y-4">
                                        <div class="bg-white/50 dark:bg-slate-800/50 p-4 rounded-xl border border-white dark:border-slate-700">
                                            <p class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold mb-2 uppercase tracking-widest">Catatan Final Teknisi</p>
                                            <p class="text-gray-800 dark:text-gray-200 text-sm whitespace-pre-wrap leading-relaxed"><?php echo e($laporan->assignment->completion_notes); ?></p>
                                        </div>
                                        
                                        <?php if($laporan->assignment->completion_photo): ?>
                                            <div>
                                                <p class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold mb-2 uppercase tracking-widest">Foto Bukti Selesai</p>
                                                <div class="relative group max-w-sm">
                                                    <img src="<?php echo e(asset('storage/' . $laporan->assignment->completion_photo)); ?>" alt="Bukti Penyelesaian" 
                                                         class="rounded-xl shadow-lg border-4 border-white dark:border-slate-800 cursor-pointer group-hover:scale-[1.02] transition-transform"
                                                         onclick="openImageModal('<?php echo e(asset('storage/' . $laporan->assignment->completion_photo)); ?>')">
                                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                                        <span class="bg-white/90 dark:bg-slate-800/90 text-gray-900 dark:text-white px-3 py-1.5 rounded-full text-[10px] font-bold shadow-lg uppercase tracking-wider">Perbesar Foto</span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="pt-2 flex items-center gap-4 text-[10px] text-gray-500 dark:text-gray-400 italic">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Verifikasi Selesai: <?php echo e($laporan->assignment->completed_at->format('d M Y, H:i')); ?>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- History Log -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden mb-6">
                <div class="p-6">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Riwayat Aktivitas
                    </h4>
                    <div class="space-y-4">
                        <?php $__empty_1 = true; $__currentLoopData = $laporan->histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-slate-700/50 rounded-xl">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center text-white text-xs font-bold shrink-0">
                                    <?php echo e(substr($history->user->name, 0, 1)); ?>

                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-900 dark:text-white"><?php echo e($history->user->name); ?></span>
                                        <span class="text-xs text-gray-500"><?php echo e($history->created_at->diffForHumans()); ?></span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5"><?php echo e($history->description); ?></p>
                                    <?php if($history->old_value && $history->new_value): ?>
                                        <p class="text-xs text-gray-500 mt-1"><?php echo e($history->old_value); ?> → <?php echo e($history->new_value); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-gray-500 text-center py-4">Belum ada riwayat aktivitas</p>
                        <?php endif; ?>
            </div>

            <!-- Internal Comments Thread -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden mb-6">
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="p-1.5 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">Diskusi Internal</h4>
                        <span class="ml-auto text-xs text-gray-500">Percakapan antara Pelapor dan Teknisi</span>
                    </div>

                    <!-- Comment List -->
                    <div class="space-y-4 mb-4 max-h-80 overflow-y-auto pr-2" id="comments-container">
                        <?php $__empty_1 = true; $__currentLoopData = $laporan->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $isMe = auth()->id() === $comment->user_id;
                            ?>
                            <div class="flex w-full <?php echo e($isMe ? 'justify-end' : 'justify-start'); ?>">
                                <div class="flex max-w-[80%] <?php echo e($isMe ? 'flex-row-reverse' : 'flex-row'); ?> items-end gap-2">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0 <?php echo e($comment->user->hasRole('teknisi') ? 'bg-gradient-to-br from-emerald-500 to-teal-600' : 'bg-gradient-to-br from-indigo-500 to-purple-600'); ?>">
                                        <?php echo e(substr($comment->user->name, 0, 1)); ?>

                                    </div>
                                    <div class="flex flex-col <?php echo e($isMe ? 'items-end' : 'items-start'); ?>">
                                        <span class="text-[10px] text-gray-500 mb-0.5 mx-1"><?php echo e($comment->user->name); ?> • <?php echo e($comment->created_at->format('H:i, d M Y')); ?></span>
                                        <div class="px-4 py-2 rounded-2xl text-sm <?php echo e($isMe ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-gray-100 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded-bl-none'); ?>">
                                            <p class="whitespace-pre-wrap"><?php echo e($comment->message); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="flex flex-col items-center justify-center py-6 opacity-50">
                                <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada diskusi.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Comment Form (only when not done/cancelled) -->
                    <?php if(!in_array($laporan->status, ['done', 'cancelled'])): ?>
                        <form action="<?php echo e(route('laporan.comments.store', $laporan)); ?>" method="POST" class="mt-2 border-t dark:border-slate-700 pt-4">
                            <?php echo csrf_field(); ?>
                            <div class="flex gap-2">
                                <textarea name="message" rows="1" required class="flex-1 resize-none border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:bg-slate-700 dark:text-white text-sm py-3" placeholder="Tulis pesan..."></textarea>
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-colors shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </div>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </form>
                        <script>
                            // Scroll to bottom of comments
                            document.addEventListener('DOMContentLoaded', function() {
                                const container = document.getElementById('comments-container');
                                if(container) {
                                    container.scrollTop = container.scrollHeight;
                                }
                            });
                        </script>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Pelapor Approval Section - Show when status is done and not yet accepted -->
            <?php if($laporan->status === 'done' && auth()->id() === $laporan->pelapor_id && !$laporan->is_accepted): ?>
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-2xl shadow-lg border border-emerald-200 dark:border-emerald-800 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-emerald-100 dark:bg-emerald-800 rounded-xl">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white">Pekerjaan Selesai!</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Teknisi telah menyelesaikan laporan ini. Silakan verifikasi hasil pekerjaan.</p>
                            </div>
                        </div>

                        <?php if($laporan->revisi_count >= 3): ?>
                            <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-red-700 dark:text-red-400">Batas Revisi Tercapai (<?php echo e($laporan->revisi_count); ?>x)</span>
                                </div>
                                <p class="text-xs text-red-600 dark:text-red-300 mt-1">Laporan ini akan di-escalate ke supervisor.</p>
                            </div>
                        <?php elseif($laporan->revisi_count > 0): ?>
                            <div class="mb-4 p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                                <p class="text-sm text-amber-700 dark:text-amber-400">
                                    <span class="font-semibold">Perhatian:</span> Laporan ini sudah direvisi <?php echo e($laporan->revisi_count); ?> kali. Sisa kesempatan revisi: <?php echo e(3 - $laporan->revisi_count); ?>x
                                </p>
                            </div>
                        <?php endif; ?>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <form method="POST" action="<?php echo e(route('laporan.accept', $laporan)); ?>" class="flex-1">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    ✅ Terima & Selesai
                                </button>
                            </form>

                            <?php if($laporan->revisi_count < 3): ?>
                                <button onclick="document.getElementById('revisi-modal').classList.remove('hidden')" class="flex-1 flex items-center justify-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-red-600 transition-all shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    ❌ Ajukan Revisi
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Revisi Modal -->
                <div id="revisi-modal" class="fixed inset-0 bg-gray-900/80 hidden items-center justify-center z-50 p-4">
                    <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-lg w-full p-6 shadow-2xl">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-xl">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Ajukan Revisi</h3>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Berikan alasan mengapa pekerjaan perlu direvisi. Teknisi akan mengerjakan ulang.</p>

                        <form method="POST" action="<?php echo e(route('laporan.reopen', $laporan)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-4">
                                <label for="alasan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alasan Revisi <span class="text-red-500">*</span></label>
                                <textarea id="alasan" name="alasan" rows="4" required class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 dark:bg-slate-700 dark:text-white" placeholder="Contoh: AC masih kurang dingin, masih ada kebocoran, dll."></textarea>
                                <?php $__errorArgs = ['alasan'];
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

                            <?php if($laporan->assignment?->teknisi): ?>
                                <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="reassign_teknisi" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">Ganti teknisi (dari: <?php echo e($laporan->assignment->teknisi->name); ?>)</span>
                                    </label>
                                </div>
                            <?php endif; ?>

                            <div class="flex gap-3">
                                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-red-600 transition-all shadow-lg">
                                    Kirim Revisi
                                </button>
                                <button type="button" onclick="document.getElementById('revisi-modal').classList.add('hidden')" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Revision History -->
            <?php if($laporan->revisions->count() > 0): ?>
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="p-1.5 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white">Riwayat Revisi</h4>
                            <span class="ml-auto px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 text-xs font-bold rounded-full"><?php echo e($laporan->revisions->count()); ?>x</span>
                        </div>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $laporan->revisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revisi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="p-4 bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-900/10 dark:to-amber-900/10 rounded-xl border border-orange-100 dark:border-orange-800">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full bg-orange-200 dark:bg-orange-800 flex items-center justify-center text-orange-700 dark:text-orange-300 text-sm font-bold shrink-0">
                                            <?php echo e($revisi->revision_number); ?>

                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="text-sm font-semibold text-gray-900 dark:text-white">Revisi #<?php echo e($revisi->revision_number); ?></span>
                                                <span class="text-xs text-gray-500"><?php echo e($revisi->reopened_at->format('d M Y H:i')); ?></span>
                                            </div>
                                            <p class="text-sm text-gray-700 dark:text-gray-300 italic">"<?php echo e($revisi->alasan); ?>"</p>
                                            <?php if($revisi->teknisi): ?>
                                                <p class="text-xs text-gray-500 mt-2">Teknisi: <?php echo e($revisi->teknisi->name); ?></p>
                                            <?php endif; ?>
                                            <?php if($revisi->resolved_at): ?>
                                                <p class="text-xs text-emerald-600 mt-1">✓ Diselesaikan <?php echo e($revisi->resolved_at->diffForHumans()); ?></p>
                                            <?php else: ?>
                                                <p class="text-xs text-amber-600 mt-1">⏳ Menunggu pengerjaan ulang</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Accepted Status Banner -->
            <?php if($laporan->is_accepted): ?>
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl shadow-lg text-white overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white/20 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold">Laporan Diterima & Selesai</h4>
                                <p class="text-sm text-emerald-100">Diterima oleh <?php echo e($laporan->pelapor->name); ?> pada <?php echo e($laporan->accepted_at?->format('d M Y H:i')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Feedback Section (visible to all if completed and feedback exists) -->
            <?php if($laporan->status === 'done' && $laporan->feedback): ?>
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="p-1.5 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white">Feedback Pelapor</h4>
                        </div>
                        <div class="flex items-center gap-2 mb-2">
                            <div class="flex">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <svg class="w-6 h-6 <?php echo e($i <= $laporan->feedback->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600'); ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <span class="font-bold text-lg text-gray-900 dark:text-white"><?php echo e($laporan->feedback->rating); ?>/5</span>
                        </div>
                        <?php if($laporan->feedback->comment): ?>
                            <p class="text-gray-700 dark:text-gray-300 italic">"<?php echo e($laporan->feedback->comment); ?>"</p>
                        <?php endif; ?>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Diberikan oleh: <?php echo e($laporan->pelapor->name); ?> • <?php echo e($laporan->feedback->created_at->format('d M Y H:i')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Feedback Form (only for pelapor if no feedback yet) -->
            <?php if($laporan->status === 'done' && auth()->id() === $laporan->pelapor_id && !$laporan->feedback): ?>
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden mb-6">
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Berikan Feedback</h4>
                        <form method="POST" action="<?php echo e(route('feedback.store', $laporan)); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Rating</label>
                                <div class="flex gap-2">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="<?php echo e($i); ?>" class="sr-only peer" required>
                                            <svg class="w-8 h-8 text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-300 transition-colors" fill="currentColor" viewBox="0 0 20 20" onclick="setRating(<?php echo e($i); ?>)">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </label>
                                    <?php endfor; ?>
                                </div>
                                <?php $__errorArgs = ['rating'];
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
                            <div class="mb-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Komentar</label>
                                <textarea id="comment" name="comment" rows="3" class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white" placeholder="Bagaimana pelayanan teknisi kami?"></textarea>
                            </div>
                            <button type="submit" class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-6 py-2 rounded-xl hover:from-yellow-600 hover:to-orange-600 transition-all">
                                Kirim Feedback
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 p-4">
                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="<?php echo e(route('laporan.index')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-4 h-4 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                    <a href="<?php echo e(route('laporan.print', $laporan)); ?>" target="_blank" class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 dark:bg-slate-900 text-white rounded-xl hover:bg-slate-700 dark:hover:bg-black transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Berita Acara
                    </a>
                </div>

                <?php if(auth()->user()->hasRole('teknisi') && in_array($laporan->status, ['pending', 'reopened'])): ?>
                    <form method="POST" action="<?php echo e(route('laporan.assign', $laporan)); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="teknisi_id" value="<?php echo e(auth()->id()); ?>">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg mt-2 sm:mt-0">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Ambil Laporan
                        </button>
                    </form>
                <?php endif; ?>

                <?php if(auth()->user()->hasRole('teknisi') && $laporan->status === 'progress' && $laporan->assignment?->teknisi_id === auth()->id()): ?>
                    <div class="flex flex-col sm:flex-row gap-2 mt-2 sm:mt-0">
                        <button onclick="document.getElementById('progress-modal').classList.remove('hidden')" class="inline-flex items-center justify-center px-6 py-2.5 bg-white dark:bg-slate-700 text-gray-700 dark:text-gray-200 font-semibold rounded-xl border border-gray-200 dark:border-slate-600 hover:bg-gray-50 dark:hover:bg-slate-600 transition-all shadow-sm">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Update Progres
                        </button>
                        <button onclick="document.getElementById('complete-modal').classList.remove('hidden')" class="inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Selesaikan Laporan
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Image Modal -->
            <div id="image-modal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50 p-4" onclick="closeImageModal()">
                <img id="modal-image" src="" alt="Full size" class="max-w-full max-h-full rounded-lg">
            </div>

            <script>
                function openImageModal(src) {
                    document.getElementById('modal-image').src = src;
                    document.getElementById('image-modal').classList.remove('hidden');
                    document.getElementById('image-modal').classList.add('flex');
                }

                function closeImageModal() {
                    document.getElementById('image-modal').classList.add('hidden');
                    document.getElementById('image-modal').classList.remove('flex');
                }

                function setRating(rating) {
                    const stars = document.querySelectorAll('input[name="rating"]');
                    stars.forEach((star, index) => {
                        const svg = star.nextElementSibling;
                        if (index < rating) {
                            svg.classList.add('text-yellow-400');
                            svg.classList.remove('text-gray-300');
                        } else {
                            svg.classList.remove('text-yellow-400');
                            svg.classList.add('text-gray-300');
                        }
                    });
                }

                // Auto-open complete modal if there are validation errors
                <?php if($errors->has('completion_notes') || $errors->has('completion_photo')): ?>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('complete-modal').classList.remove('hidden');
                        document.getElementById('complete-modal').classList.add('flex');
                    });
                <?php endif; ?>
            </script>

            <!-- Complete Modal -->
            <?php if(auth()->user()->hasRole('teknisi') && $laporan->status === 'progress'): ?>
                <!-- Progress Update Modal -->
                <div id="progress-modal" class="fixed inset-0 bg-gray-900/80 hidden items-center justify-center z-[60] p-4">
                    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl max-w-lg w-full shadow-2xl">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Update Progres</h3>
                        </div>
                        <form method="POST" action="<?php echo e(route('laporan.progress.update', $laporan)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="mb-4">
                                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Apa perkembangan terbaru? <span class="text-red-500">*</span></label>
                                <textarea id="message" name="message" rows="4" required class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-slate-700 dark:text-white" placeholder="Contoh: Sedang menunggu sparepart dari gudang, atau sedang pengecekan kabel..."></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto Pendukung (Opsional)</label>
                                <input type="file" id="photo" name="photo" accept="image/*" class="w-full border-gray-300 dark:border-gray-600 rounded-xl">
                                <p class="text-[10px] text-gray-500 mt-1">Format: JPEG, PNG, JPG (max 5MB)</p>
                            </div>
                            <div class="flex gap-3">
                                <button type="submit" class="flex-1 bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-blue-700 transition-all shadow-lg">
                                    Simpan Update
                                </button>
                                <button type="button" onclick="document.getElementById('progress-modal').classList.add('hidden')" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="complete-modal" class="fixed inset-0 bg-gray-900/80 hidden items-center justify-center z-[60] p-4">
                    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl max-w-lg w-full shadow-2xl">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Form Penyelesaian</h3>
                        </div>
                        <form method="POST" action="<?php echo e(route('laporan.complete', $laporan)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="mb-4">
                                <label for="completion_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan Penyelesaian <span class="text-red-500">*</span> (min. 5 karakter)</label>
                                <textarea id="completion_notes" name="completion_notes" rows="4" required class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 dark:bg-slate-700 dark:text-white <?php $__errorArgs = ['completion_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Jelaskan secara detail apa yang telah diperbaiki/diselesaikan..."><?php echo e(old('completion_notes')); ?></textarea>
                                <?php $__errorArgs = ['completion_notes'];
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
                            <div class="mb-4">
                                <label for="completion_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto Bukti Selesai <span class="text-red-500">*</span></label>
                                <input type="file" id="completion_photo" name="completion_photo" accept="image/*" required class="w-full border-gray-300 dark:border-gray-600 rounded-xl <?php $__errorArgs = ['completion_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php $__errorArgs = ['completion_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <p class="text-[10px] text-gray-500 mt-1">Lampirkan foto hasil akhir pekerjaan (max 5MB)</p>
                            </div>
                            <div class="flex gap-3">
                                <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg">
                                    Kirim & Selesaikan
                                </button>
                                <button type="button" onclick="document.getElementById('complete-modal').classList.add('hidden')" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/laporan/show.blade.php ENDPATH**/ ?>