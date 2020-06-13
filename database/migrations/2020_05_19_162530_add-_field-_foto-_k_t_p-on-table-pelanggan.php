<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldFotoKTPOnTablePelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pelanggan', function(Blueprint $table){
            $table->string('foto_ktp')->after('nik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('pelanggan', function(Blueprint $table){
            $table->dropColumn('foto_ktp');
        });
    }
}
