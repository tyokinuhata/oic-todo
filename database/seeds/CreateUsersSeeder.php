<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $faker = Faker\Factory::create('ja_JP');

        for ($i = 0; $i < 200; $i++) {
            User::create([
                'user_id' => $faker->userName . uniqid(),
                'password' => uniqid(),
                'token' => uniqid(),
                'total_score' => $faker->numberBetween(0, 5000)
            ]);
        }
    }
}
