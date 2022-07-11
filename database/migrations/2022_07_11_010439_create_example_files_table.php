<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('example_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('example_files')->insert([
            ['name' => 'ЭТАП 2: Запись на диагностические экзамены'],
            ['name' => 'ЭТАП 4: Подписание договора'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('example_files');
    }
};
