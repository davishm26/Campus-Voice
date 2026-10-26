<x-campus-layout>
    <x-slot name="title">Buat Pengaduan / Aspirasi - CampusVoice</x-slot>
    <x-slot name="headerTitle">Buat Pengaduan / Aspirasi</x-slot>
    <x-slot name="headerSubtitle">Sampaikan keluhan, masalah, atau aspirasi kepada pihak kampus.</x-slot>

    <!-- Success Notification -->
    @if (session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm animate-fade-in" x-data="{ show: true }" x-show="show">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 p-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- Main Form Card -->
    <div class="bg-white rounded-[28px] p-6 sm:p-10 shadow-2xl max-w-7xl mx-auto"
         x-data="{
             selectedFileName: '',
             filePreview: null,
             showLocationModal: false,
             locationVal: '{{ old('location', '') }}',
             selectLocation(loc) {
                 this.locationVal = loc;
                 this.showLocationModal = false;
             },
             handleFile(event) {
                 const file = event.target.files[0];
                 if (file) {
                     this.selectedFileName = file.name;
                     if (file.type.startsWith('image/')) {
                         const reader = new FileReader();
                         reader.onload = (e) => { this.filePreview = e.target.result; };
                         reader.readAsDataURL(file);
                     } else {
                         this.filePreview = null;
                     }
                 } else {
                     this.selectedFileName = '';
                     this.filePreview = null;
                 }
             }
         }">
        
        <!-- Section Header -->
        <div class="border-b border-gray-100 pb-5 mb-6">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Detail Laporan</h2>
            <p class="text-sm text-gray-500 mt-1">
                Isi informasi laporan dengan lengkap agar dapat ditindaklanjuti oleh pihak kampus.
            </p>
        </div>

        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- 2-Column Row: Kategori & Judul Laporan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-800 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="category" 
                                name="category" 
                                required
                                class="w-full rounded-xl border-gray-200 bg-white text-sm text-gray-700 py-3 px-4 shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 transition @error('category') border-red-400 @enderror">
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih kategori laporan</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Judul Laporan -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-800 mb-2">
                        Judul Laporan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
                           placeholder="Masukkan judul laporan" 
                           required
                           class="w-full rounded-xl border-gray-200 bg-white text-sm text-gray-700 py-3 px-4 shadow-sm placeholder:text-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500 transition @error('title') border-red-400 @enderror">
                    @error('title')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-800 mb-2">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="6" 
                          required
                          placeholder="Jelaskan keluhan, masalah, atau aspirasi kamu secara detail..."
                          class="w-full rounded-xl border-gray-200 bg-white text-sm text-gray-700 py-3.5 px-4 shadow-sm placeholder:text-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500 transition resize-y @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-800 mb-2">
                    Lokasi
                </label>
                <div class="flex flex-col sm:flex-row gap-3">
                    <input type="text" 
                           id="location" 
                           name="location" 
                           x-model="locationVal"
                           placeholder="Contoh: Kelas 2.18" 
                           class="flex-1 rounded-xl border-gray-200 bg-white text-sm text-gray-700 py-3 px-4 shadow-sm placeholder:text-gray-400 focus:border-red-500 focus:ring-1 focus:ring-red-500 transition @error('location') border-red-400 @enderror">
                    <button type="button" 
                            @click="showLocationModal = true"
                            class="px-6 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500/20 transition whitespace-nowrap shadow-sm">
                        Pilih Lokasi
                    </button>
                </div>
                @error('location')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bukti Pendukung -->
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-2">
                    Bukti Pendukung
                </label>
                <div class="relative border-2 border-dashed border-[#F3B3B7] hover:border-[#E88C93] rounded-2xl p-6 sm:p-8 text-center transition bg-white group flex flex-col items-center justify-center">
                    
                    <!-- Paperclip Icon -->
                    <div class="w-10 h-10 text-gray-400 group-hover:text-red-500 transition flex items-center justify-center mb-1">
                        <svg class="w-7 h-7 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                    </div>

                    <p class="text-sm font-medium text-gray-700">
                        Upload foto atau dokumen pendukung
                    </p>
                    <p class="text-xs text-gray-400 mt-1 mb-4">
                        Format yang didukung: JPG, PNG, PDF
                    </p>

                    <!-- File input -->
                    <div class="inline-flex items-center gap-3">
                        <label for="attachment" class="cursor-pointer">
                            <input type="file" 
                                   id="attachment" 
                                   name="attachment" 
                                   accept=".jpg,.jpeg,.png,.pdf" 
                                   @change="handleFile($event)"
                                   class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-gray-300 file:text-sm file:font-medium file:bg-white file:text-gray-700 hover:file:bg-gray-50 cursor-pointer">
                        </label>
                    </div>

                    <!-- File selected tag/preview -->
                    <template x-if="selectedFileName">
                        <div class="mt-4 p-3 bg-red-50/60 border border-red-100 rounded-xl inline-flex items-center gap-3 text-xs text-gray-700">
                            <svg class="w-4 h-4 text-[#C5222A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span x-text="selectedFileName" class="font-medium truncate max-w-xs"></span>
                        </div>
                    </template>
                </div>
                @error('attachment')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Anonymous Checkbox Box -->
            <div class="border border-red-100/80 rounded-2xl p-4 bg-white hover:bg-gray-50/50 transition flex items-start gap-3.5 shadow-sm">
                <input type="checkbox" 
                       id="is_anonymous" 
                       name="is_anonymous" 
                       value="1" 
                       {{ old('is_anonymous') ? 'checked' : '' }}
                       class="mt-1 h-4.5 w-4.5 rounded border-gray-300 text-[#C5222A] focus:ring-[#C5222A]">
                <div>
                    <label for="is_anonymous" class="text-sm font-bold text-gray-900 cursor-pointer select-none">
                        Kirim laporan secara anonim
                    </label>
                    <p class="text-xs text-gray-500 mt-0.5 select-none">
                        Identitas kamu tidak akan ditampilkan kepada publik.
                    </p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('reports.create') }}" 
                   class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 hover:text-gray-900 transition shadow-sm">
                    Batal
                </a>
                <button type="submit" 
                        class="px-7 py-2.5 rounded-xl bg-[#C5222A] hover:bg-[#A81B22] text-white text-sm font-semibold transition shadow-sm hover:shadow flex items-center gap-2">
                    Kirim Laporan
                </button>
            </div>
        </form>

        <!-- Location Picker Modal -->
        <div x-show="showLocationModal" 
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" 
                 @click="showLocationModal = false"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-gray-100"
                     @click.away="showLocationModal = false">
                    
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-red-100 text-[#C5222A] flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-gray-900">Pilih Lokasi Kampus</h3>
                        </div>
                        <button @click="showLocationModal = false" class="text-gray-400 hover:text-gray-600 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 mt-2 mb-4">
                        Pilih lokasi yang sering dilaporkan atau ketik manual pada input:
                    </p>

                    <div class="grid grid-cols-2 gap-2 max-h-64 overflow-y-auto pr-1">
                        @php
                            $campusLocations = [
                                'Kelas 2.18',
                                'Kelas 1.05',
                                'Kelas 3.12',
                                'Gedung Rektorat Lt. 1',
                                'Perpustakaan Pusat',
                                'Laboratorium Komputer',
                                'Laboratorium Bahasa',
                                'Kantin Utama',
                                'Lapangan Olahraga',
                                'Area Parkir Barat',
                                'Area Parkir Timur',
                                'Musholla / Masjid Kampus',
                                'Toilet Gedung A Lt. 2',
                                'Toilet Gedung B Lt. 1',
                                'Hall & Auditorium',
                                'Gedung Ormawa',
                            ];
                        @endphp
                        @foreach ($campusLocations as $loc)
                            <button type="button" 
                                    @click="selectLocation('{{ $loc }}')"
                                    class="text-left px-3 py-2 rounded-xl border border-gray-200 hover:border-red-300 hover:bg-red-50/50 text-xs font-medium text-gray-700 transition flex items-center justify-between group">
                                <span class="truncate">{{ $loc }}</span>
                                <span class="text-red-400 opacity-0 group-hover:opacity-100 transition text-[10px]">Pilih</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="mt-5 pt-3 border-t border-gray-100 flex justify-end">
                        <button type="button" 
                                @click="showLocationModal = false"
                                class="px-4 py-2 text-xs font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-campus-layout>
