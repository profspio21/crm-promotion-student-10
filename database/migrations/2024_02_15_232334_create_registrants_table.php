<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrantsTable extends Migration
{
    public function up()
    {
        Schema::create('registrants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_daftar')->nullable()->unique();
            $table->string('nim')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('prodi')->nullable();
            $table->string('status')->nullable();
            $table->boolean('verified')->default(1)->nullable();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
}