<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();
            $table->string('ua')->comment('userAgent')->default('');
            $table->string('location')->comment('所在城市')->default('');
            $table->string('company')->comment('所在公司')->default('');
            $table->string('job_title')->comment('职称')->default('');
            $table->text('intro')->comment('个人介绍')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profile');
    }
}
