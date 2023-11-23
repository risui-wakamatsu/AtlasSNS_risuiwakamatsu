<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('username', 255);
            $table->string('mail', 255);
            $table->string('password', 255);
            $table->string('bio', 400)->nullable();
            $table->string('images', 255)->default('bskicon.png'); //画像パスは文字だからstring型でok
            $table->timestamp('created_at')->useCurrent(('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
