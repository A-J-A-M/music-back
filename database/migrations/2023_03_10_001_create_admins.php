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
        Schema::create('t_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('encrypt_id')->nullable();
            $table->string('email')->unique();
            $table->text('password');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

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
        Schema::dropIfExists('t_admins');
    }
};
