<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-xl sm:text-2xl text-gray-800 dark:text-white">Detail Laporan</h2>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">{{ $laporan->ticket_number }}</p>
                </div>
            </div>
            <div class="self-start sm:self-auto">
                @include('components.status-badge', ['status' => $laporan->is_overdue ? 'overdue' : $laporan->status])
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Cards -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden mb-6">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-600 rounded-xl">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nomor Tiket</h4>
                            <p class="text-lg font-bold text-gray-900 dark:text-white font-mono">{{ $laporan->ticket_number }}</p>
                        </div>
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-600 rounded-xl">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Prioritas</h4>
                            @php
                                $priorityColors = [
                                    'low' => 'text-green-600 bg-green-100 dark:bg-green-900/30',
                                    'medium' => 'text-yellow-600 bg-yellow-100 dark:bg-yellow-900/30',
                                    'high' => 'text-orange-600 bg-orange-100 dark:bg-orange-900/30',
                                    'urgent' => 'text-red-600 bg-red-100 dark:bg-red-900/30',
                                ];
                                $priorityLabels = ['low' => 'Low', 'medium' => 'Medium', 'high' => 'High', 'urgent' => 'Urgent'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold {{ $priorityColors[$laporan->priority] ?? 'text-gray-600 bg-gray-100' }}">
                                {{ $priorityLabels[$laporan->priority] ?? $laporan->priority }}
                            </span>
                        </div>
                        <div class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-slate-700 dark:to-slate-600 rounded-xl {{ $laporan->is_overdue ? 'ring-2 ring-red-500' : '' }}">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Deadline</h4>
                            <p class="text-lg font-semibold {{ $laporan->is_overdue ? 'text-red-600' : 'text-gray-900 dark:text-white' }}">
                                {{ $laporan->deadline?->format('d M Y H:i') ?? 'N/A' }}
                                @if($laporan->is_overdue)
                                    <span class="text-xs bg-red-500 text-white px-2 py-0.5 rounded-full ml-2">OVERDUE</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal Laporan</h4>
                            <p class="text-gray-900 dark:text-white">{{ $laporan->report_date->format('d F Y') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pelapor</h4>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold">
                                    {{ substr($laporan->pelapor->name, 0, 1) }}
                                </div>
                                <span class="text-gray-900 dark:text-white">{{ $laporan->pelapor->name }}</span>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Department</h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-300">
                                {{ $laporan->department->name }}
                            </span>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi</h4>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                <span class="text-gray-900 dark:text-white">{{ $laporan->location }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Attachments from Pelapor -->
                    @if($laporan->attachments->where('uploaded_by', 'pelapor')->count() > 0)
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Foto Lampiran Pelapor</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach($laporan->attachments->where('uploaded_by', 'pelapor') as $attachment)
                                    <div class="relative group cursor-pointer" onclick="openImageModal('{{ asset('storage/' . $attachment->file_path) }}')">
                                        <img src="{{ asset('storage/' . $attachment->file_path) }}" alt="{{ $attachment->file_name }}" class="w-full h-32 object-cover rounded-lg">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-600 dark:text-gray-400 mb-2">Deskripsi Masalah</h4>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded">
                            <p class="whitespace-pre-wrap">{{ $laporan->description }}</p>
                        </div>
                    </div>

                    @if($laporan->assignment)
                        <div class="border-t dark:border-gray-600 pt-6">
                            <h4 class="font-semibold text-lg mb-4">Informasi Pengerjaan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <h5 class="font-semibold text-gray-600 dark:text-gray-400">Teknisi</h5>
                                    <p>{{ $laporan->assignment->teknisi->name }}</p>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-600 dark:text-gray-400">Tanggal Assignment</h5>
                                    <p>{{ $laporan->assignment->assigned_at?->format('d F Y H:i') ?? '-' }}</p>
                                </div>
                            </div>

                            @if($laporan->assignment->completed_at)
                                <div class="mb-4">
                                    <h5 class="font-semibold text-gray-600 dark:text-gray-400 mb-2">Catatan Penyelesaian</h5>
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded">
                                        <p class="whitespace-pre-wrap">{{ $laporan->assignment->completion_notes }}</p>
                                    </div>
                                </div>

                                @if($laporan->assignment->completion_photo)
                                    <div>
                                        <h5 class="font-semibold text-gray-600 dark:text-gray-400 mb-2">Foto Bukti</h5>
                                        <img src="{{ asset('storage/' . $laporan->assignment->completion_photo) }}" alt="Bukti Penyelesaian" class="max-w-md rounded">
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endif
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
                        @forelse($laporan->histories as $history)
                            <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-slate-700/50 rounded-xl">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center text-white text-xs font-bold shrink-0">
                                    {{ substr($history->user->name, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-gray-900 dark:text-white">{{ $history->user->name }}</span>
                                        <span class="text-xs text-gray-500">{{ $history->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">{{ $history->description }}</p>
                                    @if($history->old_value && $history->new_value)
                                        <p class="text-xs text-gray-500 mt-1">{{ $history->old_value }} → {{ $history->new_value }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Belum ada riwayat aktivitas</p>
                        @endforelse
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
                        @forelse($laporan->comments as $comment)
                            @php
                                $isMe = auth()->id() === $comment->user_id;
                            @endphp
                            <div class="flex w-full {{ $isMe ? 'justify-end' : 'justify-start' }}">
                                <div class="flex max-w-[80%] {{ $isMe ? 'flex-row-reverse' : 'flex-row' }} items-end gap-2">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0 {{ $comment->user->hasRole('teknisi') ? 'bg-gradient-to-br from-emerald-500 to-teal-600' : 'bg-gradient-to-br from-indigo-500 to-purple-600' }}">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                                        <span class="text-[10px] text-gray-500 mb-0.5 mx-1">{{ $comment->user->name }} • {{ $comment->created_at->format('H:i, d M Y') }}</span>
                                        <div class="px-4 py-2 rounded-2xl text-sm {{ $isMe ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-gray-100 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded-bl-none' }}">
                                            <p class="whitespace-pre-wrap">{{ $comment->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center py-6 opacity-50">
                                <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada diskusi.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Comment Form (only when not done/cancelled) -->
                    @if(!in_array($laporan->status, ['done', 'cancelled']))
                        <form action="{{ route('laporan.comments.store', $laporan) }}" method="POST" class="mt-2 border-t dark:border-slate-700 pt-4">
                            @csrf
                            <div class="flex gap-2">
                                <textarea name="message" rows="1" required class="flex-1 resize-none border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:bg-slate-700 dark:text-white text-sm py-3" placeholder="Tulis pesan..."></textarea>
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-colors shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </div>
                            @error('message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                    @endif
                </div>
            </div>

            <!-- Pelapor Approval Section - Show when status is done and not yet accepted -->
            @if($laporan->status === 'done' && auth()->id() === $laporan->pelapor_id && !$laporan->is_accepted)
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

                        @if($laporan->revisi_count >= 3)
                            <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span class="text-sm font-semibold text-red-700 dark:text-red-400">Batas Revisi Tercapai ({{ $laporan->revisi_count }}x)</span>
                                </div>
                                <p class="text-xs text-red-600 dark:text-red-300 mt-1">Laporan ini akan di-escalate ke supervisor.</p>
                            </div>
                        @elseif($laporan->revisi_count > 0)
                            <div class="mb-4 p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                                <p class="text-sm text-amber-700 dark:text-amber-400">
                                    <span class="font-semibold">Perhatian:</span> Laporan ini sudah direvisi {{ $laporan->revisi_count }} kali. Sisa kesempatan revisi: {{ 3 - $laporan->revisi_count }}x
                                </p>
                            </div>
                        @endif

                        <div class="flex flex-col sm:flex-row gap-3">
                            <form method="POST" action="{{ route('laporan.accept', $laporan) }}" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    ✅ Terima & Selesai
                                </button>
                            </form>

                            @if($laporan->revisi_count < 3)
                                <button onclick="document.getElementById('revisi-modal').classList.remove('hidden')" class="flex-1 flex items-center justify-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-red-600 transition-all shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    ❌ Ajukan Revisi
                                </button>
                            @endif
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

                        <form method="POST" action="{{ route('laporan.reopen', $laporan) }}">
                            @csrf
                            <div class="mb-4">
                                <label for="alasan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alasan Revisi <span class="text-red-500">*</span></label>
                                <textarea id="alasan" name="alasan" rows="4" required class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200 dark:bg-slate-700 dark:text-white" placeholder="Contoh: AC masih kurang dingin, masih ada kebocoran, dll."></textarea>
                                @error('alasan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            @if($laporan->assignment?->teknisi)
                                <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="reassign_teknisi" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">Ganti teknisi (dari: {{ $laporan->assignment->teknisi->name }})</span>
                                    </label>
                                </div>
                            @endif

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
            @endif

            <!-- Revision History -->
            @if($laporan->revisions->count() > 0)
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden mb-6">
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="p-1.5 bg-orange-100 dark:bg-orange-900/30 rounded-lg">
                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white">Riwayat Revisi</h4>
                            <span class="ml-auto px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300 text-xs font-bold rounded-full">{{ $laporan->revisions->count() }}x</span>
                        </div>
                        <div class="space-y-3">
                            @foreach($laporan->revisions as $revisi)
                                <div class="p-4 bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-900/10 dark:to-amber-900/10 rounded-xl border border-orange-100 dark:border-orange-800">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full bg-orange-200 dark:bg-orange-800 flex items-center justify-center text-orange-700 dark:text-orange-300 text-sm font-bold shrink-0">
                                            {{ $revisi->revision_number }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="text-sm font-semibold text-gray-900 dark:text-white">Revisi #{{ $revisi->revision_number }}</span>
                                                <span class="text-xs text-gray-500">{{ $revisi->reopened_at->format('d M Y H:i') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-700 dark:text-gray-300 italic">"{{ $revisi->alasan }}"</p>
                                            @if($revisi->teknisi)
                                                <p class="text-xs text-gray-500 mt-2">Teknisi: {{ $revisi->teknisi->name }}</p>
                                            @endif
                                            @if($revisi->resolved_at)
                                                <p class="text-xs text-emerald-600 mt-1">✓ Diselesaikan {{ $revisi->resolved_at->diffForHumans() }}</p>
                                            @else
                                                <p class="text-xs text-amber-600 mt-1">⏳ Menunggu pengerjaan ulang</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Accepted Status Banner -->
            @if($laporan->is_accepted)
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
                                <p class="text-sm text-emerald-100">Diterima oleh {{ $laporan->pelapor->name }} pada {{ $laporan->accepted_at?->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Feedback Section (visible to all if completed and feedback exists) -->
            @if($laporan->status === 'done' && $laporan->feedback)
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
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= $laporan->feedback->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $laporan->feedback->rating }}/5</span>
                        </div>
                        @if($laporan->feedback->comment)
                            <p class="text-gray-700 dark:text-gray-300 italic">"{{ $laporan->feedback->comment }}"</p>
                        @endif
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Diberikan oleh: {{ $laporan->pelapor->name }} • {{ $laporan->feedback->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            @endif

            <!-- Feedback Form (only for pelapor if no feedback yet) -->
            @if($laporan->status === 'done' && auth()->id() === $laporan->pelapor_id && !$laporan->feedback)
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden mb-6">
                    <div class="p-6">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Berikan Feedback</h4>
                        <form method="POST" action="{{ route('feedback.store', $laporan) }}">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Rating</label>
                                <div class="flex gap-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" required>
                                            <svg class="w-8 h-8 text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-300 transition-colors" fill="currentColor" viewBox="0 0 20 20" onclick="setRating({{ $i }})">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
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
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 p-4">
                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('laporan.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-4 h-4 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                    <a href="{{ route('laporan.print', $laporan) }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 bg-slate-800 dark:bg-slate-900 text-white rounded-xl hover:bg-slate-700 dark:hover:bg-black transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Berita Acara
                    </a>
                </div>

                @if(auth()->user()->hasRole('teknisi') && $laporan->status === 'progress' && $laporan->assignment?->teknisi_id === auth()->id())
                    <button onclick="document.getElementById('complete-modal').classList.remove('hidden')" class="inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg mt-2 sm:mt-0">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Selesaikan Laporan
                    </button>
                @endif
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
                @if($errors->has('completion_notes') || $errors->has('completion_photo'))
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('complete-modal').classList.remove('hidden');
                        document.getElementById('complete-modal').classList.add('flex');
                    });
                @endif
            </script>

            <!-- Complete Modal -->
            @if(auth()->user()->hasRole('teknisi') && $laporan->status === 'progress')
                <div id="complete-modal" class="fixed inset-0 bg-gray-900/80 hidden items-center justify-center z-50 p-4">
                    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl max-w-lg w-full shadow-2xl">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl">
                                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Form Penyelesaian</h3>
                        </div>
                        <form method="POST" action="{{ route('laporan.complete', $laporan) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="completion_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan Penyelesaian <span class="text-red-500">*</span> (min. 5 karakter)</label>
                                <textarea id="completion_notes" name="completion_notes" rows="4" required class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 dark:bg-slate-700 dark:text-white @error('completion_notes') border-red-500 @enderror" placeholder="Jelaskan apa yang telah dikerjakan...">{{ old('completion_notes') }}</textarea>
                                @error('completion_notes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="completion_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Foto Bukti <span class="text-red-500">*</span></label>
                                <input type="file" id="completion_photo" name="completion_photo" accept="image/*" required class="w-full border-gray-300 dark:border-gray-600 rounded-xl @error('completion_photo') border-red-500 @enderror">
                                @error('completion_photo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG (max 5MB)</p>
                            </div>
                            <div class="flex gap-3">
                                <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold px-6 py-3 rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg">
                                    Submit
                                </button>
                                <button type="button" onclick="document.getElementById('complete-modal').classList.add('hidden')" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
