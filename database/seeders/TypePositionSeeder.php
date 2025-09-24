<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_position')->truncate();

        DB::table('type_position')->insert([
            'type_position' => 'Eselon I',
            'level_position' => '1',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Eselon II',
            'level_position' => '2',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Eselon III',
            'level_position' => '3',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Eselon IV',
            'level_position' => '4',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Fungsional Ahli Utama',
            'level_position' => '5',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Fungsional Ahli Madya',
            'level_position' => '5',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Fungsional Ahli Muda',
            'level_position' => '5',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Fungsional Ahli Pertama',
            'level_position' => '5',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Fungsional Ahli Muda',
            'level_position' => '5',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Fungsional Penyelia',
            'level_position' => '5',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Fungsional Mahir',
            'level_position' => '5',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Fungsional Terampil',
            'level_position' => '5',
        ]);
        DB::table('type_position')->insert([
            'type_position' => 'Staf',
            'level_position' => '5',
        ]);
    }
}
