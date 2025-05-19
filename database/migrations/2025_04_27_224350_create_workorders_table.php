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
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('complaint')->nullable();
            $table->json('service_items'); // Menyimpan data item layanan dalam bentuk JSON

            $table->enum('status', ['pending', 'scheduled', 'in_progress', 'done', 'canceled'])->default('pending');
            $table->unsignedBigInteger('user_id')->nullable(); // Relasi ke users (role teknisi)
            $table->timestamp('scheduled_at')->nullable(); // Tanggal dan jam yang dijadwalkan
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
