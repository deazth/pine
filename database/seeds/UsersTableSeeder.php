<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'AFDZAL',
                'email' => 'test@test.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$PIBnjRISKeZlRd1HhVLdi.ZUuZordXgaDWj1dhiwk5gnfchyD6pX6',
                'staff_no' => 'S52311',
                'task_accept' => 0,
                'task_complete' => 0,
                'task_cancel' => 0,
                'task_reject' => 0,
                'task_create' => 0,
                'total_req_rating' => 0,
                'total_req_count' => 0,
                'total_do_rating' => 0,
                'total_do_count' => 0,
                'remember_token' => NULL,
                'created_at' => '2019-12-31 01:59:16',
                'updated_at' => '2019-12-31 02:03:10',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'KAHAR',
                'email' => 'test@test.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$byyLgh42wmJO4zSfFpF47OFLWjGGlCD0KoZec6SSjCUKHPRpUX/ma',
                'staff_no' => 'S53800',
                'task_accept' => 0,
                'task_complete' => 0,
                'task_cancel' => 0,
                'task_reject' => 0,
                'task_create' => 0,
                'total_req_rating' => 0,
                'total_req_count' => 0,
                'total_do_rating' => 0,
                'total_do_count' => 0,
                'remember_token' => NULL,
                'created_at' => '2019-12-31 02:02:20',
                'updated_at' => '2019-12-31 02:02:20',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'KHAFIZI',
                'email' => 'test@test.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$oEJM9a2YmSCz5TutWiPa5OJhd4Cx7w6eR4dQEsNdZ6e0lkAdzs.G.',
                'staff_no' => 'TM36886',
                'task_accept' => 0,
                'task_complete' => 0,
                'task_cancel' => 0,
                'task_reject' => 0,
                'task_create' => 0,
                'total_req_rating' => 0,
                'total_req_count' => 0,
                'total_do_rating' => 0,
                'total_do_count' => 0,
                'remember_token' => NULL,
                'created_at' => '2019-12-31 02:08:32',
                'updated_at' => '2019-12-31 02:08:32',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'AMER',
                'email' => 'test@test.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$3pUSN/vAIU/isHe0MgPzW.UV.Mbm7nZTsMkG3QeZTkp9NClcHKCny',
                'staff_no' => 'S53788',
                'task_accept' => 0,
                'task_complete' => 0,
                'task_cancel' => 0,
                'task_reject' => 0,
                'task_create' => 0,
                'total_req_rating' => 0,
                'total_req_count' => 0,
                'total_do_rating' => 0,
                'total_do_count' => 0,
                'remember_token' => NULL,
                'created_at' => '2019-12-31 02:09:27',
                'updated_at' => '2019-12-31 02:09:27',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'MIMI',
                'email' => 'test@test.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$zYTMwg5JLotDWzDa3Wl53.7AtFyoQVh4rOhyk.fvdyxzN35N1Vor2',
                'staff_no' => 'S52421',
                'task_accept' => 0,
                'task_complete' => 0,
                'task_cancel' => 0,
                'task_reject' => 0,
                'task_create' => 0,
                'total_req_rating' => 0,
                'total_req_count' => 0,
                'total_do_rating' => 0,
                'total_do_count' => 0,
                'remember_token' => NULL,
                'created_at' => '2019-12-31 02:11:18',
                'updated_at' => '2019-12-31 02:11:18',
            ),
        ));
        
        
    }
}