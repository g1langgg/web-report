<?php
    $config = [
        'pending' => [
            'class' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-300 border-amber-200 dark:border-amber-800 shadow-sm shadow-amber-500/10',
            'iconBg' => 'bg-amber-500/20',
            'icon' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
            'label' => 'Pending',
            'pulse' => true
        ],
        'progress' => [
            'class' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border-blue-200 dark:border-blue-800 shadow-sm shadow-blue-500/10',
            'iconBg' => 'bg-blue-500/20',
            'icon' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
            'label' => 'Progress',
            'pulse' => true
        ],
        'done' => [
            'class' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800 shadow-sm shadow-emerald-500/10',
            'iconBg' => 'bg-emerald-500/20',
            'icon' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
            'label' => 'Done',
            'pulse' => false
        ],
        'overdue' => [
            'class' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 border-red-200 dark:border-red-800 shadow-sm shadow-red-500/10',
            'iconBg' => 'bg-red-500/20',
            'icon' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
            'label' => 'Overdue',
            'pulse' => true
        ],
        'reopened' => [
            'class' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300 border-yellow-200 dark:border-yellow-800 shadow-sm shadow-yellow-500/10',
            'iconBg' => 'bg-yellow-500/20',
            'icon' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>',
            'label' => 'Revisi',
            'pulse' => true
        ],
        'urgent' => [
            'class' => 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-300 border-rose-200 dark:border-rose-800 shadow-sm shadow-rose-500/10',
            'iconBg' => 'bg-rose-500/20',
            'icon' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
            'label' => 'Urgent',
            'pulse' => true
        ],
    ];
    $current = $config[$status] ?? ['class' => 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300 border-gray-200 shadow-sm', 'iconBg' => 'bg-gray-500/20', 'icon' => '', 'label' => $status, 'pulse' => false];
?>

<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold border <?php echo e($current['class']); ?> <?php echo e($current['pulse'] ? 'relative overflow-hidden' : ''); ?> transition-all duration-200 hover:shadow-md hover:scale-105">
    <?php if($current['pulse']): ?>
        <span class="absolute inset-0 bg-current opacity-5 animate-pulse rounded-full"></span>
    <?php endif; ?>
    <span class="relative flex items-center">
        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full <?php echo e($current['iconBg']); ?> mr-1.5">
            <?php echo $current['icon']; ?>

        </span>
        <?php echo e($current['label']); ?>

    </span>
</span>
<?php /**PATH C:\xampp\htdocs\webreporthotel\resources\views/components/status-badge.blade.php ENDPATH**/ ?>