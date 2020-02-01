<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postingans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('judul')->nullable();
            $table->date('waktu')->nullable();
            $table->text('konten')->nullable();
            $table->string('user_id', 18);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('postingans');
    }
}
