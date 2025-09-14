<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajians', function (Blueprint $table) {
            $table->id();
            $table->string('tema',100);
            $table->string('penceramah',50);
            $table->time('waktu');
            $table->date('tanggal');
            $table->enum('jenis',['muslim & muslimah','muslimah','kuliah subuh']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajians');
    }
}
