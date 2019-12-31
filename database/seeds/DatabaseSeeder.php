<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SkillCatsTableSeeder::class);
        $this->call(SkillsTableSeeder::class);
        $this->call(TaskHistoriesTableSeeder::class);
        $this->call(TasksTableSeeder::class);
    }
}
