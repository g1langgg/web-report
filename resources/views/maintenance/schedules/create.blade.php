<x-app-layout>
    <x-slot name="header">
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
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-700 overflow-hidden">
                <form action="{{ route('maintenance.schedules.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Tugas -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Tugas <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_tugas" value="{{ old('nama_tugas') }}" required
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200"
                                placeholder="Contoh: Pengecekan Pompa Air">
                            @error('nama_tugas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Frekuensi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Frekuensi <span class="text-red-500">*</span>
                            </label>
                            <select name="frekuensi" required
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200">
                                <option value="">Pilih Frekuensi</option>
                                <option value="daily" {{ old('frekuensi') == 'daily' ? 'selected' : '' }}>Daily (Harian)</option>
                                <option value="weekly" {{ old('frekuensi') == 'weekly' ? 'selected' : '' }}>Weekly (Mingguan)</option>
                                <option value="monthly" {{ old('frekuensi') == 'monthly' ? 'selected' : '' }}>Monthly (Bulanan)</option>
                            </select>
                            @error('frekuensi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="lokasi" value="{{ old('lokasi') }}" required
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200"
                                placeholder="Contoh: Lantai 1 - Ruang Pompa">
                            @error('lokasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teknisi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Teknisi <span class="text-red-500">*</span>
                            </label>
                            <select name="teknisi_id" required
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200">
                                <option value="">Pilih Teknisi</option>
                                @foreach($teknisis as $teknisi)
                                    <option value="{{ $teknisi->id }}" {{ old('teknisi_id') == $teknisi->id ? 'selected' : '' }}>
                                        {{ $teknisi->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teknisi_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Waktu Mulai -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Waktu Mulai (Opsional)
                            </label>
                            <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai') }}"
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200">
                            @error('waktu_mulai')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" rows="3"
                                class="w-full border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white focus:border-amber-500 focus:ring focus:ring-amber-200"
                                placeholder="Deskripsi tugas maintenance...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Aktif -->
                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
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
                            @if(old('checklists'))
                                @foreach(old('checklists') as $index => $checklist)
                                    <div class="checklist-item bg-gray-50 dark:bg-slate-700/50 rounded-lg p-4 mb-3">
                                        <div class="flex items-start gap-4">
                                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama Item</label>
                                                    <input type="text" name="checklists[{{ $index }}][item_name]" value="{{ $checklist['item_name'] }}" required
                                                        class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white"
                                                        placeholder="Contoh: Tekanan air normal">
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Deskripsi (Opsional)</label>
                                                    <input type="text" name="checklists[{{ $index }}][deskripsi]" value="{{ $checklist['deskripsi'] ?? '' }}"
                                                        class="w-full text-sm border-gray-300 dark:border-gray-600 rounded-lg dark:bg-slate-700 dark:text-white"
                                                        placeholder="Penjelasan detail">
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="checklists[{{ $index }}][is_required]" value="1" {{ ($checklist['is_required'] ?? true) ? 'checked' : '' }}
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
                                @endforeach
                            @else
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
                            @endif
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-gray-200 dark:border-slate-700">
                        <a href="{{ route('maintenance.schedules.index') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium">
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
        let checklistIndex = {{ old('checklists') ? count(old('checklists')) : 1 }};

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
</x-app-layout>
