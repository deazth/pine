<?php

use Illuminate\Database\Seeder;

class TaskHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('task_histories')->delete();
        
        \DB::table('task_histories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'task_id' => 1,
                'user_id' => 1,
                'description' => 'Created new task request',
                'created_at' => '2019-12-31 09:43:36',
                'updated_at' => '2019-12-31 09:43:36',
            ),
            1 => 
            array (
                'id' => 2,
                'task_id' => 1,
                'user_id' => 1,
                'description' => 'Advertised task',
                'created_at' => '2019-12-31 09:43:37',
                'updated_at' => '2019-12-31 09:43:37',
            ),
            2 => 
            array (
                'id' => 3,
                'task_id' => 2,
                'user_id' => 1,
                'description' => 'Created new task request',
                'created_at' => '2019-12-31 09:51:19',
                'updated_at' => '2019-12-31 09:51:19',
            ),
            3 => 
            array (
                'id' => 4,
                'task_id' => 2,
                'user_id' => 1,
                'description' => 'Advertised task',
                'created_at' => '2019-12-31 09:51:19',
                'updated_at' => '2019-12-31 09:51:19',
            ),
            4 => 
            array (
                'id' => 5,
                'task_id' => 3,
                'user_id' => 1,
                'description' => 'Created new task request',
                'created_at' => '2019-12-31 09:54:28',
                'updated_at' => '2019-12-31 09:54:28',
            ),
            5 => 
            array (
                'id' => 6,
                'task_id' => 3,
                'user_id' => 1,
                'description' => 'Advertised task',
                'created_at' => '2019-12-31 09:54:28',
                'updated_at' => '2019-12-31 09:54:28',
            ),
            6 => 
            array (
                'id' => 7,
                'task_id' => 4,
                'user_id' => 1,
                'description' => 'Created new task request',
                'created_at' => '2019-12-31 09:55:43',
                'updated_at' => '2019-12-31 09:55:43',
            ),
            7 => 
            array (
                'id' => 8,
                'task_id' => 4,
                'user_id' => 1,
                'description' => 'Advertised task',
                'created_at' => '2019-12-31 09:55:43',
                'updated_at' => '2019-12-31 09:55:43',
            ),
            8 => 
            array (
                'id' => 9,
                'task_id' => 5,
                'user_id' => 1,
                'description' => 'Created new task request',
                'created_at' => '2019-12-31 09:58:00',
                'updated_at' => '2019-12-31 09:58:00',
            ),
            9 => 
            array (
                'id' => 10,
                'task_id' => 5,
                'user_id' => 1,
                'description' => 'Advertised task',
                'created_at' => '2019-12-31 09:58:00',
                'updated_at' => '2019-12-31 09:58:00',
            ),
            10 => 
            array (
                'id' => 11,
                'task_id' => 6,
                'user_id' => 5,
                'description' => 'Created new task request',
                'created_at' => '2019-12-31 10:02:27',
                'updated_at' => '2019-12-31 10:02:27',
            ),
            11 => 
            array (
                'id' => 12,
                'task_id' => 6,
                'user_id' => 5,
                'description' => 'Advertised task',
                'created_at' => '2019-12-31 10:02:27',
                'updated_at' => '2019-12-31 10:02:27',
            ),
        ));
        
        
    }
}