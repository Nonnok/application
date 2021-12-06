<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('works')->truncate();
        $works = [
            [
                'user_id' => '1', 
                'id' => '1',
                'punchIn' => date('Y-m-d H:i:s'),
                'punchOut' => date('Y-m-d H:i:s'),
                'date' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => '2',
                'id' => '2',
                'punchIn' => ''
            ],
            [
                'user_id' => '3',
                'id' => '3',
                'punchIn' => '',
                'punchOut' => '',
                'date' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => '4',
                'id' => '4',
                'punchIn' => '',
                'punchOut' => '',
                'date' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => '5',
                'id' => '5',
                'punchIn' => '',
                'punchOut' => '',
                'date' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => '6',
                'id' => '6',
                'punchIn' => '',
                'punchOut' => '',
                'date' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => '7',
                'id' => '7',
                'punchIn' => '',
                'punchOut' => '',
                'date' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'user_id' => $user['user_id'],
                'id' => $user['id'],
                'punchIn' => $user['punchIn'],
                'punchOut' => bcrypt('punchOut'),
                'date' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
