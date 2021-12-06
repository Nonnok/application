<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $users = [
            [
                'id' => '1', 
                'name' => '山田太郎',
                'email' => 'tarou@email.com',
            ],
            [
                'id' => '2',
                'name' => '山田次郎',
                'email' => 'jirou@email.com'
            ],
            [
                'id' => '3',
                'name' => '山田三郎',
                'email' => 'saburou@email.com',
            ],
            [
                'id' => '4',
                'name' => '山田四郎',
                'email' => 'sirou@email.com',
            ],
            [
                'id' => '5',
                'name' => '山田五郎',
                'email' => 'gorou@email.com',
            ],
            [
                'id' => '6',
                'name' => '山田六郎',
                'email' => 'rokurou@email.com',
            ],
            [
                'id' => '7',
                'name' => '山田七郎',
                'email' => 'sitirou@email.com',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt('password'),
                'created_at' => DateTime::dateTimeThisDecade(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
