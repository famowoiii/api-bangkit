<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Franchise;
use Faker\Factory as Faker;

class FranchiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            Franchise::create([
                'nama' => $faker->company,
                
                'foto' => $faker->imageUrl(640, 480, 'business', true),
                'kontak' => $faker->phoneNumber,
                'harga' => $faker->numberBetween(1000000, 10000000),
                'paket' => $faker->word,
                'deskripsi' => $faker->paragraph,
            ]);
        }
    }
}
