<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisToJadwalImamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_imams', function (Blueprint $table) {
            $table->enum('jenis',['sholat fardu', 'sholat jumat', 'sholat teraweh'])->nullable()->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_imams', function (Blueprint $table) {
            $table->dropColumn('jenis'); 
        });
    }
}
