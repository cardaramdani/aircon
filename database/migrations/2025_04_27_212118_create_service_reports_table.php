<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workorder_id'); // Relasi ke workorders
            $table->unsignedBigInteger('technician_id'); // Teknisi yang bertugas
            $table->text('description')->nullable(); // Deskripsi hasil servis
            $table->string('photo_before')->nullable(); // Foto sebelum servis
            $table->string('photo_after')->nullable(); // Foto sesudah servis
            $table->timestamps();

            $table->foreign('workorder_id')->references('id')->on('workorders')->onDelete('cascade');
            $table->foreign('technician_id')->references('id')->on('users')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_reports');
    }
}
