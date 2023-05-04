<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('encrypt_id')->nullable();
            $table->string('title');
            $table->string('url')->unique();
            $table->boolean('outside');
            $table->string('description');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('genre_id')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->foreign('type_id')->references('id')->on('c_types');
            $table->foreign('level_id')->references('id')->on('c_levels');
            $table->foreign('admin_id')->references('id')->on('t_admins');
            $table->foreign('genre_id')->references('id')->on('c_genres');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_media');
    }
};
