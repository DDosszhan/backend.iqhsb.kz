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
        Schema::table('banners', function (Blueprint $table) {
            $table->json('settings')->default(json_encode([
                'has_content' => false,
                'cropper_width' => 1120,
                'cropper_height' => 442,
            ]));
        });

        $now = Carbon\Carbon::now();
        $data = [
            [
                'slug' => 'home',
                'title' => 'IQanat high school of Burabay',
                'settings' => [
                    'has_content' => true,
                    'cropper_width' => 640,
                    'cropper_height' => 610,
                ],
            ],
            [
                'slug' => 'school_life',
                'title' => 'Жизнь в школе',
                'settings' => [
                    'has_content' => false,
                    'cropper_width' => 1120,
                    'cropper_height' => 442,
                ],
            ],
            [
                'slug' => 'program',
                'title' => 'Программа обучения',
                'settings' => [
                    'has_content' => false,
                    'cropper_width' => 1120,
                    'cropper_height' => 442,
                ],
            ],
            [
                'slug' => 'admissions',
                'title' => 'Как поступить',
                'settings' => [
                    'has_content' => false,
                    'cropper_width' => 1120,
                    'cropper_height' => 442,
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
                'settings' => json_encode($element['settings']),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        Illuminate\Support\Facades\DB::table('banners')->truncate();
        Illuminate\Support\Facades\DB::table('banners')->insert($insertData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('settings');
        });
    }
};
