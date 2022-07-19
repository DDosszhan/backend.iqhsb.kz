<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('pages', function (Blueprint $table) {
            $table->json('settings')->default(json_encode([
                'block_count' => 0,
                'removable' => true,
            ]));
        });

        $now = Carbon\Carbon::now();
        $data = [
            [
                'slug' => 'about',
                'title' => 'О школе',
                'blocks' => null,
                'settings' => [
                    'has_image' => false,
                    'has_gallery' => true,
                    'gallery_width' => 352,
                    'block_count' => 0,
                    'removable' => false,
                ],
            ],
            [
                'slug' => 'program',
                'title' => 'Учебные программы школы',
                'blocks' => [
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
                ],
                'settings' => [
                    'has_image' => false,
                    'has_gallery' => false,
                    'gallery_width' => false,
                    'block_count' => 3,
                    'removable' => false,
                ],
            ],
        ];
        $insertData = [];
        foreach ($data as $element) {
            $insertData[] = [
                'slug' => $element['slug'],
                'title' => json_encode([
                    'kk' => $element['title'],
                    'ru' => $element['title'],
                    'en' => $element['title'],
                ]),
                'blocks' => json_encode($element['blocks']),
                'settings' => json_encode($element['settings']),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        Illuminate\Support\Facades\DB::table('pages')->truncate();
        Illuminate\Support\Facades\DB::table('pages')->insert($insertData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('settings');
        });
    }
};
