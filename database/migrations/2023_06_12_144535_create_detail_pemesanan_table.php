<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemesanan', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_pemesanan');
            $table->unsignedBigInteger('id_menu');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan');
            $table->foreign('id_menu')->references('id_menu')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_pemesanan', function (Blueprint $table) {
            $table->dropForeign(['id_pemesanan']);
            $table->dropForeign(['id_menu']);
        });
        Schema::dropIfExists('detail_pemesanan');
    }
}
