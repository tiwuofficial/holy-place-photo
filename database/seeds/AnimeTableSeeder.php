<?php

use App\Model\Anime;
use Illuminate\Database\Seeder;

class AnimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvPath = __DIR__. '/data/anime.csv';

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('animes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = new SplFileObject($csvPath);
        $data->setFlags(SplFileObject::READ_CSV);

        foreach ($data as $index => $line) {
            // 1行目はヘッダー行なのでスキップ
            if ($index > 0) {
                $model = new Anime();
                $model->name = $line[4];
                $model->name_kana = $line[6];
                $model->save();
            }
        }
    }
}
