<?php

use Illuminate\Database\Seeder;
use App\Task;
use Carbon\Carbon;

class CreateTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::truncate();
        $faker = Faker\Factory::create('ja_JP');

        $begin = Carbon::create(2015, 1, 1, 0, 0, 0);
        $end = Carbon::create(2020, 12, 31, 23, 59, 59);

        $min = strtotime($begin);
        $max = strtotime($end);

        for ($i = 0; $i < 30; $i++) {
            Task::create([
                'task_id'=> uniqid(),
                'title' => $faker->word,
                'description' => $faker->text($maxNbChars = 200),
                'completed' => $faker->boolean($chanceOfGettingTrue = 50),
                'score' => $faker->numberBetween(0, 500),
                'user_id' => 'tyokinuhata',
                'created_at' => date(rand($min, $max))
            ]);
        }
    }
}
