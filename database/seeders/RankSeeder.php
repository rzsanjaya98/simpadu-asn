<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ranks')->truncate();

        DB::table('ranks')->insert([
            'rank_name' => 'Juru Muda',
            'rank_group' => 'I',
            'rank_room' => 'a',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Juru Muda Tingkat I',
            'rank_group' => 'I',
            'rank_room' => 'b',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Juru',
            'rank_group' => 'I',
            'rank_room' => 'c',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Juru Tingkat I',
            'rank_group' => 'I',
            'rank_room' => 'd',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Pengatur Muda',
            'rank_group' => 'II',
            'rank_room' => 'a',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Pengatur Muda Tingkat I',
            'rank_group' => 'II',
            'rank_room' => 'b',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Pengatur',
            'rank_group' => 'II',
            'rank_room' => 'c',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Pengatur Tingkat I',
            'rank_group' => 'II',
            'rank_room' => 'd',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Penata Muda',
            'rank_group' => 'III',
            'rank_room' => 'a',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Penata Muda Tingkat I',
            'rank_group' => 'III',
            'rank_room' => 'b',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Penata',
            'rank_group' => 'III',
            'rank_room' => 'c',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Penata Tingkat I',
            'rank_group' => 'III',
            'rank_room' => 'd',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Pembina',
            'rank_group' => 'IV',
            'rank_room' => 'a',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Pembina Tingkat I',
            'rank_group' => 'IV',
            'rank_room' => 'b',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Pembina Utama Muda',
            'rank_group' => 'IV',
            'rank_room' => 'c',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Pembina Utama Madya',
            'rank_group' => 'IV',
            'rank_room' => 'd',
        ]);

        DB::table('ranks')->insert([
            'rank_name' => 'Pembina Utama ',
            'rank_group' => 'IV',
            'rank_room' => 'e',
        ]);
    }
}
