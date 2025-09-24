<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DivisionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisions')->truncate();
        $bappeda = Division::create([
            'division_name' => 'Badan Perencanaan Pembangunan Daerah',
            'level' => 1
        ]);

        $sekretariat = Division::create([
            'division_name' => 'Sekretariat',
            'parent_id' => $bappeda->id,
            'level' => 2
        ]);

        Division::create([
            'division_name' => 'Sub Bagian Umum dan Kepegawaian',
            'parent_id' => $sekretariat->id,
            'level' => 3
        ]);

        Division::create([
            'division_name' => 'Sub Bagian Keuangan',
            'parent_id' => $sekretariat->id,
            'level' => 3
        ]);

        Division::create([
            'division_name' => 'Bidang Perencanaan Makro',
            'parent_id' => $bappeda->id,
            'level' => 2
        ]);

        Division::create([
            'division_name' => 'Bidang Ekonomi dan Sumber Daya Alam',
            'parent_id' => $bappeda->id,
            'level' => 2
        ]);

        Division::create([
            'division_name' => 'Bidang Pembangunan Manusia dan Masyarakat',
            'parent_id' => $bappeda->id,
            'level' => 2
        ]);

        Division::create([
            'division_name' => 'Bidang Infrastruktur dan Pengembangan Wilayah',
            'parent_id' => $bappeda->id,
            'level' => 2
        ]);
    }
}
