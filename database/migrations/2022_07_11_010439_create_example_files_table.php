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
            $table->string('slug')->unique();
            $table->timestamps();

            $table->index('slug');
        });

        \Illuminate\Support\Facades\DB::table('example_files')->insert([
            [
                'name' => 'ЭТАП 2: Запись на диагностические экзамены',
                'slug' => 'stage_2',
            ],
            [
                'name' => 'ЭТАП 4: Подписание договора',
                'slug' => 'stage_4',
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('example_files');
    }
};
