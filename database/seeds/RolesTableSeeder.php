<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Super Admin',
            'Admin',
            'Short Admin',
            'Tiny Admin',
            'Normal User'
        ];

        foreach ($data as $datum) {
            Role::insert(
                [
                    'name' => $datum
                ]
            );
        }
    }
}
