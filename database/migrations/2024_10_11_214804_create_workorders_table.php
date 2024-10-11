<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Relasi ke tabel users
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->json('service_items'); // Menyimpan data item layanan dalam bentuk JSON
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
        Schema::dropIfExists('workorders');
    }
}
