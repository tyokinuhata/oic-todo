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

        for ($i = 0; $i < 30; $i++) {
            Task::create([
                'task_id'=> uniqid(),
                'title' => $faker->word,
                'description' => $faker->text($maxNbChars = 200),
                'completed' => false,
                'score' => $faker->numberBetween(0, 500),
                'user_id' => 'tyokinuhata',
                'reopen_at' => $this->getRandomDate(2015)
            ]);
        }
    }

    /**
     * ランダムな日時をYYYY-MM-DD HH:MM:SSで返すメソッド
     * @param $beginYear
     * @param $endYear
     * @return false|string
     */
    protected function getRandomDate($beginYear)
    {
        $start = Carbon::create($beginYear, 1, 1, 0, 0, 0);
        $end = Carbon::now();

        $min = strtotime($start);
        $max = strtotime($end);

        $date = rand($min, $max);
        $date = date('Y-m-d H:i:s', $date);

        return $date;
    }
}
