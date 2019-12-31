<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tasks')->delete();
        
        \DB::table('tasks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'reference_no' => '20191231-00000001-72993',
                'name' => 'ACCOUNT BALANCING FOR NOVA',
                'descr' => 'One time job to clear accrual data from SIEBEL and ICP NOVA',
                'user_id' => 1,
                'assign_id' => NULL,
                'parent_id' => NULL,
                'status' => 'Advertised',
                'skill_id' => 5,
                'skill_cat_id' => 3,
                'rating_user' => NULL,
                'rating_assign' => NULL,
                'success_rating_user' => NULL,
                'success_rating_assign' => NULL,
                'submit_date' => NULL,
                'complete_date' => NULL,
                'accepted_date' => NULL,
                'created_at' => '2019-12-31 09:43:36',
                'updated_at' => '2019-12-31 09:43:36',
            ),
            1 => 
            array (
                'id' => 2,
                'reference_no' => '20191231-00000001-16758',
                'name' => 'RPA job',
                'descr' => 'Robotic Process Automation configuration for mass emails to customer',
                'user_id' => 1,
                'assign_id' => NULL,
                'parent_id' => NULL,
                'status' => 'Advertised',
                'skill_id' => 8,
                'skill_cat_id' => 2,
                'rating_user' => NULL,
                'rating_assign' => NULL,
                'success_rating_user' => NULL,
                'success_rating_assign' => NULL,
                'submit_date' => NULL,
                'complete_date' => NULL,
                'accepted_date' => NULL,
                'created_at' => '2019-12-31 09:51:19',
                'updated_at' => '2019-12-31 09:51:19',
            ),
            2 => 
            array (
                'id' => 3,
                'reference_no' => '20191231-00000001-16045',
                'name' => 'Event Manager for KASTEL',
                'descr' => 'Managing logistic and scheduling',
                'user_id' => 1,
                'assign_id' => NULL,
                'parent_id' => NULL,
                'status' => 'Advertised',
                'skill_id' => 9,
                'skill_cat_id' => 2,
                'rating_user' => NULL,
                'rating_assign' => NULL,
                'success_rating_user' => NULL,
                'success_rating_assign' => NULL,
                'submit_date' => NULL,
                'complete_date' => NULL,
                'accepted_date' => NULL,
                'created_at' => '2019-12-31 09:54:28',
                'updated_at' => '2019-12-31 09:54:43',
            ),
            3 => 
            array (
                'id' => 4,
                'reference_no' => '20191231-00000001-49896',
                'name' => 'PHP Application',
                'descr' => 'Developing front end PHP application to consume API from ERA.',
                'user_id' => 1,
                'assign_id' => NULL,
                'parent_id' => NULL,
                'status' => 'Advertised',
                'skill_id' => 4,
                'skill_cat_id' => 2,
                'rating_user' => NULL,
                'rating_assign' => NULL,
                'success_rating_user' => NULL,
                'success_rating_assign' => NULL,
                'submit_date' => NULL,
                'complete_date' => NULL,
                'accepted_date' => NULL,
                'created_at' => '2019-12-31 09:55:43',
                'updated_at' => '2019-12-31 09:55:43',
            ),
            4 => 
            array (
                'id' => 5,
                'reference_no' => '20191231-00000001-75812',
                'name' => 'PMCARE integration',
                'descr' => 'Integrating PMCARE api with TM application',
                'user_id' => 1,
                'assign_id' => NULL,
                'parent_id' => NULL,
                'status' => 'Advertised',
                'skill_id' => 1,
                'skill_cat_id' => 2,
                'rating_user' => NULL,
                'rating_assign' => NULL,
                'success_rating_user' => NULL,
                'success_rating_assign' => NULL,
                'submit_date' => NULL,
                'complete_date' => NULL,
                'accepted_date' => NULL,
                'created_at' => '2019-12-31 09:58:00',
                'updated_at' => '2019-12-31 09:58:00',
            ),
            5 => 
            array (
                'id' => 6,
                'reference_no' => '20191231-00000005-87341',
                'name' => 'MC for jom sembang',
                'descr' => 'Hosting for Jom Bersama event',
                'user_id' => 5,
                'assign_id' => '2',
                'parent_id' => NULL,
                'status' => 'Proposed',
                'skill_id' => 10,
                'skill_cat_id' => 2,
                'rating_user' => NULL,
                'rating_assign' => NULL,
                'success_rating_user' => NULL,
                'success_rating_assign' => NULL,
                'submit_date' => NULL,
                'complete_date' => NULL,
                'accepted_date' => NULL,
                'created_at' => '2019-12-31 10:02:27',
                'updated_at' => '2019-12-31 10:05:34',
            ),
        ));
        
        
    }
}