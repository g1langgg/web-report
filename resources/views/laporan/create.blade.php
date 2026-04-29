<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-white">Buat Laporan Baru</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('laporan.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Department & Priority -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="department_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Department <span class="text-red-500">*</span>
                                </label>
                                <select id="department_id" name="department_id" class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white @error('department_id') border-red-500 @enderror" required>
                                    <option value="">Pilih Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="priority" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Prioritas
                                </label>
                                <select id="priority" name="priority" class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white">
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>🟢 Low - Tidak urgent</option>
                                    <option value="medium" {{ old('priority') == 'medium' || !old('priority') ? 'selected' : '' }}>🟡 Medium - Normal</option>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>🟠 High - Penting</option>
                                    <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>🔴 Urgent - Segera ditangani</option>
                                </select>
                            </div>
                        </div>

                        <!-- Report Date & Location -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="report_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Laporan <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="report_date" name="report_date" value="{{ old('report_date', date('Y-m-d')) }}" class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white @error('report_date') border-red-500 @enderror" required>
                                @error('report_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="location" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Lokasi Masalah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Contoh: Lobi Lt.1, Kamar 205, Dapur, dll" class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white @error('location') border-red-500 @enderror" required>
                                @error('location')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi Masalah <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="4" placeholder="Jelaskan detail masalah yang ditemukan..." class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Photo Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Lampiran Foto
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors cursor-pointer" onclick="document.getElementById('attachments').click()">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                        <label for="attachments" class="relative cursor-pointer bg-transparent rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                            <span>Upload foto</span>
                                            <input id="attachments" name="attachments[]" type="file" class="sr-only" multiple accept="image/*" onchange="previewFiles(this)">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG up to 5MB (max 5 files)</p>
                                </div>
                            </div>
                            <div id="file-preview" class="mt-3 grid grid-cols-2 md:grid-cols-5 gap-3"></div>
                            @error('attachments.*')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-between gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('laporan.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Simpan Laporan
                            </button>
                        </div>
                    </form>

                    <script>
                        function previewFiles(input) {
                            const preview = document.getElementById('file-preview');
                            preview.innerHTML = '';
                            
                            if (input.files) {
                                Array.from(input.files).forEach((file, index) => {
                                    if (file.type.startsWith('image/')) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            const div = document.createElement('div');
                                            div.className = 'relative';
                                            div.innerHTML = `
                                                <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg">
                                                <button type="button" onclick="removeFile(${index})" class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full text-xs hover:bg-red-600">×</button>
                                                <p class="text-xs text-gray-500 truncate mt-1">${file.name}</p>
                                            `;
                                            preview.appendChild(div);
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                });
                            }
                        }

                        function removeFile(index) {
                            const input = document.getElementById('attachments');
                            const dt = new DataTransfer();
                            const { files } = input;
                            
                            for (let i = 0; i < files.length; i++) {
                                if (i !== index) dt.items.add(files[i]);
                            }
                            
                            input.files = dt.files;
                            previewFiles(input);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
