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
        Schema::create('narasumbers', function (Blueprint $table) {
            $table->id();
            $table->string('kode_narasumber')->unique();
            $table->string('nama_lengkap');
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('instansi')->nullable();
            $table->string('jabatan_instansi')->nullable();
            $table->string('bidang_keahlian')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('telepon_kantor')->nullable();
            $table->string('telepon_pribadi')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telegram')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('universitas')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->enum('status', ['aktif', 'nonaktif', 'blacklist', 'pensiun'])->default('aktif');
            $table->text('catatan_khusus')->nullable();
            $table->string('foto_profil')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            // Index untuk pencarian
            $table->index('nama_lengkap');
            $table->index('bidang_keahlian');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('narasumbers');
    }
};