<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeLeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_leaves')->truncate();

        DB::table('type_leaves')->insert([
            'type_leave' => 'Cuti Tahunan',
        ]);

        DB::table('type_leaves')->insert([
            'type_leave' => 'Cuti Besar',
        ]);

        DB::table('type_leaves')->insert([
            'type_leave' => 'Cuti Sakit',
        ]);

        DB::table('type_leaves')->insert([
            'type_leave' => 'Cuti Melahirkan',
        ]);

        DB::table('type_leaves')->insert([
            'type_leave' => 'Cuti Karena Alasan Penting',
        ]);

        DB::table('type_leaves')->insert([
            'type_leave' => 'Cuti Di Luar Tanggungan Negara',
        ]);
    }
}
