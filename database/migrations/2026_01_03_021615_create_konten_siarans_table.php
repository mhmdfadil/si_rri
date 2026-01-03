<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('konten_siarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_konten', 50)->unique();
            $table->string('judul');
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onDelete('set null');
            
            // Informasi Siaran
            $table->date('tanggal_siaran');
            $table->time('jam_siaran');
            $table->integer('durasi')->comment('Durasi dalam menit');
            $table->string('segmen')->nullable()->comment('Segmen acara jika ada');
            $table->enum('tipe_siaran', ['live', 'rekaman', 'tunda'])->default('live');
            $table->enum('jenis_konten', ['wawancara', 'talkshow', 'berita', 'feature', 'musik', 'dialog', 'lainnya'])->default('wawancara');
            
            // Studio & Tim
            $table->string('studio')->nullable()->comment('Studio yang digunakan');
            $table->string('produser')->nullable();
            $table->string('penyiar')->nullable();
            $table->string('operator')->nullable();
            $table->text('tim_produksi')->nullable()->comment('Tim produksi lainnya (JSON)');
            
            // Konten
            $table->text('deskripsi')->nullable();
            $table->text('topik_bahasan')->nullable();
            $table->text('rundown')->nullable()->comment('Rundown acara');
            $table->text('naskah')->nullable()->comment('Naskah atau skrip');
            $table->text('catatan_produksi')->nullable();
            
            // File & Media
            $table->string('file_audio')->nullable()->comment('Path file audio rekaman');
            $table->string('thumbnail')->nullable();
            $table->text('file_pendukung')->nullable()->comment('File pendukung lainnya (JSON)');
            
            // Metadata
            $table->string('hashtag')->nullable();
            $table->text('kata_kunci')->nullable()->comment('Keywords untuk pencarian');
            $table->integer('jumlah_pendengar')->nullable()->default(0);
            $table->decimal('rating', 3, 2)->nullable()->comment('Rating 0-5');
            
            // Status & Approval
            $table->enum('status', ['draft', 'diajukan', 'disetujui', 'ditolak', 'siap_tayang', 'tayang', 'selesai', 'dibatalkan'])->default('draft');
            $table->foreignId('diajukan_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('tanggal_diajukan')->nullable();
            $table->timestamp('tanggal_disetujui')->nullable();
            $table->text('catatan_approval')->nullable();
            
            // Replay & Archiving
            $table->boolean('dapat_diulang')->default(true);
            $table->timestamp('tanggal_tayang_ulang')->nullable();
            $table->boolean('arsip')->default(false);
            $table->string('nomor_arsip')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('tanggal_siaran');
            $table->index('jam_siaran');
            $table->index('status');
            $table->index('tipe_siaran');
            $table->index('jenis_konten');
            $table->index(['tanggal_siaran', 'jam_siaran']);
        });

        // Tabel pivot untuk relasi konten dengan narasumber
        Schema::create('konten_siaran_narasumber', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konten_siaran_id')->constrained('konten_siarans')->onDelete('cascade');
            $table->foreignId('narasumber_id')->constrained('narasumbers')->onDelete('cascade');
            $table->string('peran')->nullable()->comment('Peran narasumber: narasumber utama, tamu, komentator, dll');
            $table->integer('durasi_tampil')->nullable()->comment('Durasi tampil dalam menit');
            $table->decimal('honor', 15, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->unique(['konten_siaran_id', 'narasumber_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konten_siaran_narasumber');
        Schema::dropIfExists('konten_siarans');
    }
};