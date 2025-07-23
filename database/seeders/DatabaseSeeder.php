<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(KaryawanSeeder::class);

        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('surveys')->insert([
                // contoh kolom, sesuaikan dengan migration Anda
                'nama'                 => $faker->name(),
                'kualitas_produk'      => $faker->numberBetween(1, 5),
                'pelayanan'            => $faker->numberBetween(1, 5),
                'pengiriman'           => $faker->numberBetween(1, 5),
                'kemudahan_transaksi'  => $faker->numberBetween(1, 5),
                'harga_nilai'          => $faker->numberBetween(1, 5),
                'after_sales'          => $faker->numberBetween(1, 5),
                'kepuasan_umum'        => $faker->numberBetween(1, 5),
                'nps'                  => $faker->numberBetween(0, 10),
                'saran'                => $faker->optional(0.7)->sentence(),
                // acak tanggal antara 30 hari terakhir
                'created_at'           => Carbon::now()->subDays(rand(0, 30)),
                'updated_at'           => Carbon::now(),
            ]);
        }
    }
}
