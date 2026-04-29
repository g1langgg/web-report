<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-white">Notifikasi</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Semua notifikasi Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($notifications->where('is_read', false)->count() > 0)
                <div class="mb-4 flex justify-end">
                    <form method="POST" action="{{ route('notifications.read-all') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Tandai Semua Dibaca
                        </button>
                    </form>
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden">
                <div class="divide-y divide-gray-100 dark:divide-slate-700">
                    @forelse($notifications as $notification)
                        <div class="p-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors {{ !$notification->is_read ? 'bg-indigo-50/30 dark:bg-indigo-900/10' : '' }}">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0
                                    @switch($notification->type)
                                        @case('new_laporan') bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 @break
                                        @case('status_changed') bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400 @break
                                        @case('assigned') bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400 @break
                                        @case('completed') bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400 @break
                                        @case('overdue') bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400 @break
                                        @default bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400
                                    @endswitch
                                ">
                                    @switch($notification->type)
                                        @case('new_laporan')
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            @break
                                        @case('status_changed')
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            @break
                                        @case('assigned')
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            @break
                                        @case('completed')
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            @break
                                        @case('overdue')
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            @break
                                        @default
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                    @endswitch
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $notification->title }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $notification->message }}</p>
                                            <div class="flex items-center gap-2 mt-2">
                                                @if($notification->laporan)
                                                    <a href="{{ route('laporan.show', $notification->laporan_id) }}" class="text-xs text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 font-medium">
                                                        Lihat Laporan #{{ $notification->laporan->ticket_number }}
                                                    </a>
                                                    <span class="text-gray-300">•</span>
                                                @endif
                                                <span class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        @if(!$notification->is_read)
                                            <span class="w-2 h-2 bg-indigo-500 rounded-full shrink-0"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 dark:bg-slate-700 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            <p class="text-lg font-medium text-gray-900 dark:text-white">Tidak ada notifikasi</p>
                            <p class="text-sm text-gray-500 mt-1">Anda belum memiliki notifikasi apapun</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
