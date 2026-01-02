@extends('layouts.app')

@section('title', 'Edit Narasumber')
@section('page-title', 'Edit Narasumber')
@section('page-subtitle', 'Perbarui data narasumber')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('narasumber.show', $narasumber) }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('narasumber.update', $narasumber) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Data Pribadi Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Data Pribadi</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Foto Profil</label>
                        <div class="text-center">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-emerald-100 shadow-lg mx-auto">
                                <div id="photoPreview" class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    @if($narasumber->foto_profil)
                                        <img src="{{ asset('storage/' . $narasumber->foto_profil) }}" alt="{{ $narasumber->nama_lengkap }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    @endif
                                </div>
                            </div>
                            <label for="foto_profil" class="cursor-pointer inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-lg hover:bg-emerald-100 transition-colors font-medium text-sm mt-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Ubah Foto
                            </label>
                            <input type="file" id="foto_profil" name="foto_profil" class="hidden" accept="image/*" onchange="previewPhoto(event)">
                            <p class="text-xs text-gray-500 mt-2">Max. 2MB</p>
                            @if($narasumber->foto_profil)
                                <label class="flex items-center justify-center gap-2 text-xs text-red-600 mt-2 cursor-pointer">
                                    <input type="checkbox" name="remove_photo" value="1" class="rounded">
                                    Hapus foto
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="lg:col-span-3 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gelar Depan</label>
                                <input type="text" name="gelar_depan" value="{{ old('gelar_depan', $narasumber->gelar_depan) }}" placeholder="Dr., Prof." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $narasumber->nama_lengkap) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none @error('nama_lengkap') border-red-500 @enderror">
                                @error('nama_lengkap')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gelar Belakang</label>
                                <input type="text" name="gelar_belakang" value="{{ old('gelar_belakang', $narasumber->gelar_belakang) }}" placeholder="S.H., M.M." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $narasumber->tempat_lahir) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $narasumber->tanggal_lahir) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                                    <option value="">Pilih</option>
                                    @foreach(\App\Models\Narasumber::JENIS_KELAMIN_OPTIONS as $k => $v)
                                        <option value="{{ $k }}" {{ old('jenis_kelamin', $narasumber->jenis_kelamin) == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $narasumber->pendidikan_terakhir) }}" placeholder="S1, S2, S3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Universitas</label>
                                <input type="text" name="universitas" value="{{ old('universitas', $narasumber->universitas) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instansi & Keahlian -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Instansi & Keahlian</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instansi</label>
                        <input type="text" name="instansi" value="{{ old('instansi', $narasumber->instansi) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                        <input type="text" name="jabatan_instansi" value="{{ old('jabatan_instansi', $narasumber->jabatan_instansi) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bidang Keahlian <span class="text-red-500">*</span></label>
                    <input type="text" name="bidang_keahlian" value="{{ old('bidang_keahlian', $narasumber->bidang_keahlian) }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none @error('bidang_keahlian') border-red-500 @enderror">
                    @error('bidang_keahlian')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Informasi Kontak</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $narasumber->email) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none @error('email') border-red-500 @enderror">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telepon Kantor</label>
                        <input type="text" name="telepon_kantor" value="{{ old('telepon_kantor', $narasumber->telepon_kantor) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telepon Pribadi</label>
                        <input type="text" name="telepon_pribadi" value="{{ old('telepon_pribadi', $narasumber->telepon_pribadi) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $narasumber->whatsapp) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Telegram</label>
                        <input type="text" name="telegram" value="{{ old('telegram', $narasumber->telegram) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Alamat -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Alamat</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">{{ old('alamat', $narasumber->alamat) }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan</label>
                        <input type="text" name="kelurahan" value="{{ old('kelurahan', $narasumber->kelurahan) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $narasumber->kecamatan) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                        <input type="text" name="kota" value="{{ old('kota', $narasumber->kota) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $narasumber->provinsi) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                        <input type="text" name="kode_pos" value="{{ old('kode_pos', $narasumber->kode_pos) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Sosial -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Media Sosial</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                        <input type="url" name="linkedin" value="{{ old('linkedin', $narasumber->linkedin) }}" placeholder="https://linkedin.com/in/username" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                        <input type="text" name="facebook" value="{{ old('facebook', $narasumber->facebook) }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $narasumber->instagram) }}" placeholder="@username" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Twitter/X</label>
                        <input type="text" name="twitter" value="{{ old('twitter', $narasumber->twitter) }}" placeholder="@username" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Catatan -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Status & Catatan</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">
                        @foreach(\App\Models\Narasumber::STATUS_OPTIONS as $k => $v)
                            <option value="{{ $k }}" {{ old('status', $narasumber->status) == $k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Khusus</label>
                    <textarea name="catatan_khusus" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none">{{ old('catatan_khusus', $narasumber->catatan_khusus) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center gap-3 mb-6">
            <button type="submit" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Update Narasumber
            </button>
            <a href="{{ route('narasumber.show', $narasumber) }}" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
@endsection