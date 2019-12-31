<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('skills')->delete();
        
        \DB::table('skills')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Java',
                'skill_cat_id' => 2,
                'govern_by' => 'Oracle',
                'descr' => 'Java programming language',
                'updated_by' => NULL,
                'created_at' => '2019-12-30 18:15:28',
                'updated_at' => '2019-12-31 01:04:52',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'DIGITAL CUSTOMER EXPERIENCE',
                'skill_cat_id' => 4,
                'govern_by' => NULL,
                'descr' => 'Digital customer experience',
                'updated_by' => NULL,
                'created_at' => '2019-12-31 01:06:09',
                'updated_at' => '2019-12-31 01:06:09',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'GEMS HCM',
                'skill_cat_id' => 3,
                'govern_by' => 'TM',
                'descr' => 'GEMS HCM system  for TM',
                'updated_by' => NULL,
                'created_at' => '2019-12-31 01:13:13',
                'updated_at' => '2019-12-31 01:13:13',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'PHP',
                'skill_cat_id' => 2,
                'govern_by' => NULL,
                'descr' => 'PHP Programming including basic framework',
                'updated_by' => NULL,
                'created_at' => '2019-12-31 01:14:01',
                'updated_at' => '2019-12-31 01:14:01',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'NOVA & ICP',
                'skill_cat_id' => 3,
                'govern_by' => NULL,
                'descr' => 'Account maintenance for TM customers',
                'updated_by' => NULL,
                'created_at' => '2019-12-31 01:16:10',
                'updated_at' => '2019-12-31 01:16:10',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Business Model Innovation',
                'skill_cat_id' => 4,
                'govern_by' => NULL,
                'descr' => 'Business Model Innovation',
                'updated_by' => NULL,
                'created_at' => '2019-12-31 01:17:19',
                'updated_at' => '2019-12-31 01:17:19',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'ABAP',
                'skill_cat_id' => 2,
                'govern_by' => 'SAP',
                'descr' => 'ABAP programming for SAP',
                'updated_by' => NULL,
                'created_at' => '2019-12-31 01:22:50',
                'updated_at' => '2019-12-31 01:22:50',
            ),
        ));
        
        
    }
}