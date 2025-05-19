<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workorder_id'); // Relasi ke workorders
            $table->string('name'); // Pelanggan yang memberi rating
            $table->unsignedBigInteger('technician_id'); // Teknisi yang dinilai
            $table->tinyInteger('rating'); // 1 - 5
            $table->text('review_text')->nullable(); // Ulasan tambahan
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
        Schema::dropIfExists('ratings');
    }
}
