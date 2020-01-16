<?php

use App\Convert\CSVtoArray;
use Illuminate\Database\Seeder;

class CitiesDistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SEEDER Cities
        $csv_regency = new CSVtoArray;
        $file_regency = public_path() . '/assets/csv/cities.csv';
        $header_regency = array('id', 'name');
        $data_regency = $csv_regency->csv_to_array($file_regency, $header_regency);
        $data_regency = array_map(function ($arr) {
            return $arr + ['created_at' => now()];
        }, $data_regency);

        $collection_regency = collect($data_regency);
        foreach ($collection_regency->chunk(50) as $ch) {
            DB::table('cities')->insert($ch->toArray());
        }

        // SEEDER District
        $csv_district = new CSVtoArray;
        $file_district = public_path() . '/assets/csv/districts.csv';
        $header_district = array('id', 'city_id', 'name');
        $data_district = $csv_district->csv_to_array($file_district, $header_district);
        $data_district = array_map(function ($arr) {
            return $arr + ['created_at' => now()];
        }, $data_district);

        $collection_district = collect($data_district);
        foreach ($collection_district->chunk(50) as $chunk) {
            DB::table('districts')->insert($chunk->toArray());
        }

        /**
         * Thanks To : Laravolt/Indonesia
         * https://github.com/laravolt/indonesia
         */
    }
}
