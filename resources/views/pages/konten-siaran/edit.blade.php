@extends('layouts.app')

@section('title', 'Edit Konten Siaran')
@section('page-title', 'Edit Konten Siaran')
@section('page-subtitle', $kontenSiaran->kode_konten)

@section('content')
<div class="max-w-full mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('konten-siaran.show', $kontenSiaran) }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Detail
        </a>
    </div>

    <form action="{{ route('konten-siaran.update', $kontenSiaran) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Informasi Dasar -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Informasi Dasar</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Thumbnail</label>
                        <div class="text-center">
                            <div class="w-full h-48 rounded-lg overflow-hidden border-2 border-dashed border-gray-300 bg-gray-50">
                                <div id="thumbnailPreview" class="w-full h-full">
                                    @if($kontenSiaran->thumbnail)
                                    <img src="{{ $kontenSiaran->thumbnail_url }}" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="text-xs text-gray-500">16:9 Recommended</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <label for="thumbnail" class="cursor-pointer inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-100 transition-colors font-medium text-sm mt-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                {{ $kontenSiaran->thumbnail ? 'Ganti Thumbnail' : 'Upload Thumbnail' }}
                            </label>
                            <input type="file" id="thumbnail" name="thumbnail" class="hidden" accept="image/*" onchange="previewThumbnail(event)">
                            <p class="text-xs text-gray-500 mt-2">Max. 2MB (JPG, PNG)</p>
                        </div>
                    </div>
                    <div class="lg:col-span-3 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Konten</label>
                            <input type="text" value="{{ $kontenSiaran->kode_konten }}" disabled class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Konten <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul', $kontenSiaran->judul) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none @error('judul') border-red-500 @enderror" placeholder="Masukkan judul konten siaran">
                            @error('judul')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Program <span class="text-red-500">*</span></label>
                                <select name="program_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none @error('program_id') border-red-500 @enderror">
                                    <option value="">Pilih Program</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program->id }}" {{ old('program_id', $kontenSiaran->program_id) == $program->id ? 'selected' : '' }}>{{ $program->nama_program }}</option>
                                    @endforeach
                                </select>
                                @error('program_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                                <select name="kategori_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none @error('kategori_id') border-red-500 @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $kontenSiaran->kategori_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Deskripsi singkat konten">{{ old('deskripsi', $kontenSiaran->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal & Teknis -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Jadwal & Teknis Siaran</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Siaran <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_siaran" value="{{ old('tanggal_siaran', $kontenSiaran->tanggal_siaran->format('Y-m-d')) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none @error('tanggal_siaran') border-red-500 @enderror">
                        @error('tanggal_siaran')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jam Siaran <span class="text-red-500">*</span></label>
                        <input type="time" name="jam_siaran" value="{{ old('jam_siaran', \Carbon\Carbon::parse($kontenSiaran->jam_siaran)->format('H:i')) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none @error('jam_siaran') border-red-500 @enderror">
                        @error('jam_siaran')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (Menit) <span class="text-red-500">*</span></label>
                        <input type="number" name="durasi" value="{{ old('durasi', $kontenSiaran->durasi) }}" min="1" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none @error('durasi') border-red-500 @enderror">
                        @error('durasi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Siaran <span class="text-red-500">*</span></label>
                        <select name="tipe_siaran" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                            @foreach(\App\Models\KontenSiaran::TIPE_SIARAN_OPTIONS as $k => $v)
                                <option value="{{ $k }}" {{ old('tipe_siaran', $kontenSiaran->tipe_siaran) == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Konten <span class="text-red-500">*</span></label>
                        <select name="jenis_konten" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                            @foreach(\App\Models\KontenSiaran::JENIS_KONTEN_OPTIONS as $k => $v)
                                <option value="{{ $k }}" {{ old('jenis_konten', $kontenSiaran->jenis_konten) == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Studio</label>
                        <input type="text" name="studio" value="{{ old('studio', $kontenSiaran->studio) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Contoh: Studio 1">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Segmen</label>
                        <input type="text" name="segmen" value="{{ old('segmen', $kontenSiaran->segmen) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Contoh: Segmen 1, Segmen 2">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tim Produksi -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Tim Produksi</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Produser</label>
                        <input type="text" name="produser" value="{{ old('produser', $kontenSiaran->produser) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Penyiar</label>
                        <input type="text" name="penyiar" value="{{ old('penyiar', $kontenSiaran->penyiar) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Operator</label>
                    <input type="text" name="operator" value="{{ old('operator', $kontenSiaran->operator) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none">
                </div>
            </div>
        </div>

        <!-- Konten & Naskah -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Konten & Naskah</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Topik Bahasan</label>
                    <textarea name="topik_bahasan" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Topik yang akan dibahas dalam siaran">{{ old('topik_bahasan', $kontenSiaran->topik_bahasan) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rundown</label>
                    <textarea name="rundown" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Rundown siaran">{{ old('rundown', $kontenSiaran->rundown) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Naskah</label>
                    <textarea name="naskah" rows="6" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Naskah lengkap siaran">{{ old('naskah', $kontenSiaran->naskah) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Produksi</label>
                    <textarea name="catatan_produksi" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Catatan khusus untuk tim produksi">{{ old('catatan_produksi', $kontenSiaran->catatan_produksi) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Metadata -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Metadata & Tags</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hashtag</label>
                    <input type="text" name="hashtag" value="{{ old('hashtag', $kontenSiaran->hashtag) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="#hashtag1 #hashtag2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kata Kunci</label>
                    <input type="text" name="kata_kunci" value="{{ old('kata_kunci', $kontenSiaran->kata_kunci) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="kata kunci, pisahkan dengan koma">
                </div>

                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="dapat_diulang" value="1" {{ old('dapat_diulang', $kontenSiaran->dapat_diulang) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">Konten dapat ditayangkan ulang</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center gap-3 mb-6">
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Perubahan
            </button>
            <a href="{{ route('konten-siaran.show', $kontenSiaran) }}" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    function previewThumbnail(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('thumbnailPreview').innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection