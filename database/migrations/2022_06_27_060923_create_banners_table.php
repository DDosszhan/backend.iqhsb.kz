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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('content')->nullable();
            $table->json('button_text')->nullable();
            $table->json('button_url')->nullable();
            $table->timestamps();

            $table->index('slug');
        });

        $now = Carbon\Carbon::now();
        Illuminate\Support\Facades\DB::table('banners')->insert([
            [
                'slug' => 'home',
                'title' => json_encode([
                    'kk' => 'IQanat high school of Burabay',
                    'ru' => 'IQanat high school of Burabay',
                    'en' => 'IQanat high school of Burabay',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'school_life',
                'title' => json_encode([
                    'kk' => 'Жизнь в школе',
                    'ru' => 'Жизнь в школе',
                    'en' => 'Жизнь в школе',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'program',
                'title' => json_encode([
                    'kk' => 'Программа обучения',
                    'ru' => 'Программа обучения',
                    'en' => 'Программа обучения',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'admissions',
                'title' => json_encode([
                    'kk' => 'Как поступить',
                    'ru' => 'Как поступить',
                    'en' => 'Как поступить',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
