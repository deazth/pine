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
                'id' => 2,
                'name' => 'PROGRAMMING',
                'descr' => 'Programming Skills',
                'updated_by' => NULL,
                'created_at' => '2019-12-27 09:06:17',
                'updated_at' => '2019-12-27 09:06:17',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'BAU SYSTEM',
                'descr' => 'Operational skill that are TM specific',
                'updated_by' => NULL,
                'created_at' => '2019-12-27 09:07:28',
                'updated_at' => '2019-12-31 01:03:19',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'SOFT SKILLS',
                'descr' => 'Soft skills include adaptability, attitude, communication, creative thinking, work ethic, teamwork, networking, decision making, positivity, time management, motivation, flexibility, problem-solving, critical thinking, and conflict resolution.',
                'updated_by' => NULL,
                'created_at' => '2019-12-31 01:02:53',
                'updated_at' => '2019-12-31 01:02:53',
            ),
        ));
        
        
    }
}