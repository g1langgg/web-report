<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-xl sm:text-2xl text-gray-800 dark:text-white">Edit Laporan</h2>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">{{ $laporan->ticket_number }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('laporan.update', $laporan) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="department_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Department <span class="text-red-500">*</span>
                                </label>
                                <select id="department_id" name="department_id" class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white @error('department_id') border-red-500 @enderror" required>
                                    <option value="">Pilih Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id', $laporan->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="report_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Laporan <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="report_date" name="report_date" value="{{ old('report_date', $laporan->report_date->format('Y-m-d')) }}" class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white @error('report_date') border-red-500 @enderror" required>
                                @error('report_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Lokasi Masalah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="location" name="location" value="{{ old('location', $laporan->location) }}" class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white @error('location') border-red-500 @enderror" required>
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi Masalah <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="4" class="w-full border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-slate-700 dark:text-white @error('description') border-red-500 @enderror" required>{{ old('description', $laporan->description) }}</textarea>
                            @error('description')
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Update Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
