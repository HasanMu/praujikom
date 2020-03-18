<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class QuranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Kosongkan Table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('quran_surah')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('quran_ayat')->truncate();

        $json_surah = json_decode(File::get('public/json/qs.json'));

        for ($i=0; $i < 114; $i++) {
            DB::table('quran_surah')->insert([
                'nama'      => $json_surah->data[$i]->nama,
                'asma'      => $json_surah->data[$i]->asma,
                'arti'      => $json_surah->data[$i]->arti,
                'jml_ayat'      => $json_surah->data[$i]->ayat,
                'type'      => $json_surah->data[$i]->type,
                'keterangan'      => $json_surah->data[$i]->keterangan,
            ]);
        }

        $data_QS = DB::table('quran_surah')->get();

        $json_ayat = [];
        foreach ($data_QS as $data) {
            $json_ayat = File::get('public/json/QSAyat/'.$data->id.'.json');

            if(!$json_ayat) {
                File::put('public/json/QSAyat/'.$data->id.'.json', $json_ayat);
            }

            $id = $data->id;
            foreach (json_decode($json_ayat) as $data) {
                DB::table('quran_ayat')->insert([
                    'qs_id'     => $id,
                    'arab'      => $data->ar,
                    'arti'      => $data->id,
                    'latin'     => $data->tr,
                    'ayat'      => $data->nomor,
                ]);
            }
            $json_ayat = [];
        }

    }
}
