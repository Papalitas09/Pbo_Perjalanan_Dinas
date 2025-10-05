<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\pegawai;
class catatandinasSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i <= 10; $i++){
            $faker = Faker::create('id_ID');
            DB::table("catatandinas")->insert([
                'lokasi' => $faker->address,
                'tanggal_berangkat' => $faker->date(),
                'tanggal_pulang' => $faker->date(),
                'no_induk'  => pegawai::where('role', 'pegawai')->inRandomOrder()->first()->no_induk,
                'status' => $faker->randomElement(['Belum Berlangsung', 'Berlangsung',  'Selesai']),
                'catatan_lainnya' => 'kurang tau apa',
                'status_tampil' => $faker->randomElement(['Tertunda', 'Disetujui',  'Ditolak'])
            ]);

        }
    }
}
