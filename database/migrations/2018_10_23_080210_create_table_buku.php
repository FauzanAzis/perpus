<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->unsignedInteger('pengarang_id')->index();
            $table->unsignedInteger('penerbit_id')->index();
            $table->unsignedInteger('klasifikasi_id')->index();
            $table->string('bahasa')->nullable();
            $table->string('edisi')->nullable();
            $table->string('isbn')->nullable();
            $table->string('deskripsi')->nullable();
            $table->unsignedInteger('stok')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('pengarang_id')
                ->references('id')
                ->on('pengarang');
            $table->foreign('penerbit_id')
                ->references('id')
                ->on('penerbit');

            $table->foreign('klasifikasi_id')
                ->references('id')
                ->on('klasifikasi');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
