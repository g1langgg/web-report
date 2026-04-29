<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-800 dark:text-white">Detail Jadwal Maintenance</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Informasi lengkap jadwal dan histori task</p>
                </div>
            </div>
            @if(auth()->user()->hasRole(['admin', 'manager', 'pelapor']))
                <div class="flex items-center gap-2">
                    <a href="{{ route('maintenance.schedules.edit', $schedule) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('maintenance.schedules.index') }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Jadwal</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Schedule Info Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-200 dark:border-slate-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-200 dark:border-slate-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Informasi Jadwal</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Nama Tugas</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $schedule->nama_tugas }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Frekuensi</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        {{ $schedule->frekuensi === 'daily' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $schedule->frekuensi === 'weekly' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $schedule->frekuensi === 'monthly' ? 'bg-emerald-100 text-emerald-800' : '' }}">
                                        {{ ucfirst($schedule->frekuensi) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Lokasi</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $schedule->lokasi }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Teknisi</p>
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                                            <span class="text-white text-sm font-bold">{{ substr($schedule->teknisi->name, 0, 1) }}</span>
                                        </div>
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $schedule->teknisi->name }}</p>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Deskripsi</p>
                                    <p class="text-gray-900 dark:text-white">{{ $schedule->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Tasks -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-200 dark:border-slate-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-200 dark:border-slate-700 flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Histori Task Terbaru</h3>
                            <a href="{{ route('maintenance.tasks.index') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                Lihat Semua →
                            </a>
                        </div>
                        <div class="p-6">
                            @if($schedule->tasks->count() > 0)
                                <div class="space-y-3">
                                    @foreach($schedule->tasks as $task)
                                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-slate-700/50 rounded-xl">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full flex items-center justify-center
                                                    {{ $task->isPending() ? 'bg-amber-100 text-amber-600' : '' }}
                                                    {{ $task->isOngoing() ? 'bg-blue-100 text-blue-600' : '' }}
                                                    {{ $task->isCompleted() ? 'bg-emerald-100 text-emerald-600' : '' }}">
                                                    @if($task->isPending())
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    @elseif($task->isOngoing())
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900 dark:text-white">{{ $task->tanggal_jadwal->format('d M Y') }}</p>
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                        {{ $task->status === 'pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                                        {{ $task->status === 'ongoing' ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $task->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : '' }}">
                                                        {{ ucfirst($task->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                            @if($task->result_status)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                    {{ $task->result_status === 'normal' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                                    {{ $task->result_status === 'need_repair' ? 'bg-amber-100 text-amber-800' : '' }}
                                                    {{ $task->result_status === 'urgent' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $task->result_status)) }}
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p>Belum ada task yang dibuat.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-200 dark:border-slate-700 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">Status Jadwal</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $schedule->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                                <div class="w-3 h-3 rounded-full {{ $schedule->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Checklist Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-200 dark:border-slate-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-200 dark:border-slate-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Checklist Item</h3>
                        </div>
                        <div class="p-6">
                            @if($schedule->checklists->count() > 0)
                                <div class="space-y-2">
                                    @foreach($schedule->checklists->sortBy('urutan') as $checklist)
                                        <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                                            <div class="flex-shrink-0 w-6 h-6 rounded border-2 border-gray-300 dark:border-gray-600 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-900 dark:text-white">{{ $checklist->item_name }}</p>
                                                @if($checklist->deskripsi)
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $checklist->deskripsi }}</p>
                                                @endif
                                                @if($checklist->is_required)
                                                    <span class="inline-block mt-1 px-2 py-0.5 bg-red-100 text-red-700 text-xs rounded">Wajib</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-center text-gray-500 dark:text-gray-400 py-4">Tidak ada checklist item.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
