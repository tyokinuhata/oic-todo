<?php

use Illuminate\Database\Seeder;
use App\Task;

class CreateTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');

        for ($i = 0; $i < 30; $i++) {
            Task::create([
                'task_id'=> uniqid(),
                'title' => $faker->word,
                'description' => $faker->text($maxNbChars = 200),
                'completed' => $faker->boolean($chanceOfGettingTrue = 50),
                'score' => $faker->numberBetween(0, 500),
                'user_id' => 'tyokinuhata'
            ]);
        }
    }
}
