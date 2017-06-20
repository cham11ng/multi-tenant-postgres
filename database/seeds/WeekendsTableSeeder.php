<?php

use App\Weekend;
use Illuminate\Database\Seeder;

class WeekendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Weekend::truncate();

        $data = [
            'Saturday',
            'Sunday',
        ];

        foreach ($data as $datum) {
            Weekend::insert(
                [
                    'name' => $datum
                ]
            );
        }
    }
}
