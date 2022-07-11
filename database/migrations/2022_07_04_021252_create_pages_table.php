<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('content')->nullable();
            $table->json('blocks')->nullable();
            $table->timestamps();

            $table->index('slug');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
