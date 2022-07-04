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

        $now = Carbon\Carbon::now();
        Illuminate\Support\Facades\DB::table('pages')->insert([
            [
                'slug' => 'home',
                'title' => json_encode([
                    'kk' => 'IQanat high school of Burabay',
                    'ru' => 'IQanat high school of Burabay',
                    'en' => 'IQanat high school of Burabay',
                ]),
                'blocks' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'program',
                'title' => json_encode([
                    'kk' => 'Учебные программы школы',
                    'ru' => 'Учебные программы школы',
                    'en' => 'Учебные программы школы',
                ]),
                'blocks' => json_encode([
                    [
                        'title' => [
                            'kk' => 'Основные курсы',
                            'ru' => 'Основные курсы',
                            'en' => 'Основные курсы',
                        ],
                        'content' => [
                            'kk' => 'Обучение предназначено для тех детей, которые увлечены программированием и математикой. Профильными предметами являются информатика, алгебра и геометрия.',
                            'ru' => 'Обучение предназначено для тех детей, которые увлечены программированием и математикой. Профильными предметами являются информатика, алгебра и геометрия.',
                            'en' => 'Обучение предназначено для тех детей, которые увлечены программированием и математикой. Профильными предметами являются информатика, алгебра и геометрия.',
                        ],
                    ],
                    [
                        'title' => [
                            'kk' => 'Элективные курсы',
                            'ru' => 'Элективные курсы',
                            'en' => 'Элективные курсы',
                        ],
                        'content' => [
                            'kk' => 'Внутри направления в рамках разных учебных планов возможны акценты на разные предметные области. Профильными предметами являются химия, биология и физика.',
                            'ru' => 'Внутри направления в рамках разных учебных планов возможны акценты на разные предметные области. Профильными предметами являются химия, биология и физика.',
                            'en' => 'Внутри направления в рамках разных учебных планов возможны акценты на разные предметные области. Профильными предметами являются химия, биология и физика.',
                        ],
                    ],
                    [
                        'title' => [
                            'kk' => 'Подготовительные курсы',
                            'ru' => 'Подготовительные курсы',
                            'en' => 'Подготовительные курсы',
                        ],
                        'content' => [
                            'kk' => 'Профильными предметами являются география, история, обществознание и литература. Углубленное изучение осуществляется в за счет посещения спецкурсов по этим предметам.',
                            'ru' => 'Профильными предметами являются география, история, обществознание и литература. Углубленное изучение осуществляется в за счет посещения спецкурсов по этим предметам.',
                            'en' => 'Профильными предметами являются география, история, обществознание и литература. Углубленное изучение осуществляется в за счет посещения спецкурсов по этим предметам.',
                        ],
                    ],
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};