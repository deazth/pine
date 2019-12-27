<?php

use Illuminate\Database\Seeder;

class SkillCatsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('skill_cats')->delete();
        
        \DB::table('skill_cats')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'KIPAS',
                'descr' => 'Soft skills',
                'updated_by' => NULL,
                'created_at' => '2019-12-27 09:05:43',
                'updated_at' => '2019-12-27 09:05:43',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'PROGRAMMING',
                'descr' => 'Programming Skills',
                'updated_by' => NULL,
                'created_at' => '2019-12-27 09:06:17',
                'updated_at' => '2019-12-27 09:06:17',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'BAU',
                'descr' => 'Operational skill that are TM related',
                'updated_by' => NULL,
                'created_at' => '2019-12-27 09:07:28',
                'updated_at' => '2019-12-27 09:07:28',
            ),
        ));
        
        
    }
}